<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MigrateToR2 extends Command
{
    protected $signature = 'migrate:to-r2 {--path=media : Folder name to migrate from (e.g., media, images, uploads)} {--limit= : Limit number of files to migrate (optional)} {--dry-run : Show what would be migrated without actually migrating}';
    protected $description = 'Migrate files from storage/app/public/media to Cloudflare R2';

    public function handle()
    {
        $folder = $this->option('path');
        $localPath = storage_path("app/public/$folder");
        $r2Disk = Storage::disk('s3');
        $dryRun = $this->option('dry-run');

        if (!File::isDirectory($localPath)) {
            $this->error("Directory not found: $localPath");
            return 1;
        }

        // Get all files recursively
        $files = File::allFiles($localPath);

        // Apply limit if specified
        $limit = $this->option('limit');
        if ($limit) {
            $files = array_slice($files, 0, (int) $limit);
        }

        $totalFiles = count($files);

        if ($totalFiles === 0) {
            $this->info('No files found to migrate.');
            return 0;
        }

        $this->info("Found $totalFiles files to migrate.");

        if ($dryRun) {
            $this->info("\n--- DRY RUN MODE ---");
        }

        $successCount = 0;
        $failCount = 0;

        $this->withProgressBar($files, function ($file) use ($r2Disk, $localPath, $folder, $dryRun, &$successCount, &$failCount) {
            try {
                // Get relative path from media folder
                $relativePath = $file->getRelativePathname();

                // Create R2 path with folder prefix
                $r2Path = $folder . '/' . $relativePath;

                if (!$dryRun) {
                    // Read file content
                    $content = File::get($file->getRealPath());

                    // Upload to R2
                    $r2Disk->put($r2Path, $content);
                }

                $successCount++;
            } catch (\Exception $e) {
                $failCount++;
                $this->line("\nError uploading {$relativePath}: " . $e->getMessage());
            }
        });

        $this->newLine();
        $this->info("\n--- Migration Summary ---");
        $this->info("Successfully migrated: $successCount files");
        if ($failCount > 0) {
            $this->error("Failed: $failCount files");
        }

        if ($dryRun) {
            $this->info("\nTo perform the actual migration, run without --dry-run:");
            $this->line("php artisan migrate:to-r2");
        }

        return 0;
    }
}