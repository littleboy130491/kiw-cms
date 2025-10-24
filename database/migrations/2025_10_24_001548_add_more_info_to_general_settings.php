<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.email_2', config('cms.site_email_2', 'admin@example.com'));
        $this->migrator->add('general.wbs_email', config('cms.wbs_email', 'admin@example.com'));
        $this->migrator->add('general.address_2', config('cms.site_address_2'));
        $this->migrator->add('general.address_3', config('cms.site_address_3'));
        $this->migrator->add('general.link_address_1', config('cms.link_address_1'));
        $this->migrator->add('general.link_address_2', config('cms.link_address_2'));
        $this->migrator->add('general.link_address_3', config('cms.link_address_3'));

    }

    public function down(): void
    {
        $this->migrator->delete('general.email_2');
        $this->migrator->delete('general.wbs_email');
        $this->migrator->delete('general.address_2');
        $this->migrator->delete('general.address_3');
        $this->migrator->delete('general.link_address_1');
        $this->migrator->delete('general.link_address_2');
        $this->migrator->delete('general.link_address_3');
    }
};
