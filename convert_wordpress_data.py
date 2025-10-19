import csv
import json
import re
from datetime import datetime

def parse_multilingual_field(field_str):
    """Parse multilingual field from JSON string or return as-is if not JSON"""
    if not field_str or field_str == 'NULL':
        return {"id": None}
    
    try:
        # Try to parse as JSON
        parsed = json.loads(field_str)
        if isinstance(parsed, dict):
            return parsed
        else:
            return {"id": field_str}
    except:
        # If not valid JSON, return as-is
        return {"id": field_str}

def extract_categories(categories_str):
    """Extract category IDs from categories string"""
    if not categories_str or categories_str == 'NULL':
        return []
    
    # Try to parse as JSON first
    try:
        categories = json.loads(categories_str)
        if isinstance(categories, list):
            return categories
        elif isinstance(categories, dict) and 'id' in categories:
            return [categories['id']]
        else:
            return []
    except:
        # If not JSON, try to extract numbers using regex
        numbers = re.findall(r'\d+', str(categories_str))
        return [int(n) for n in numbers]

def convert_posts(input_file, output_file):
    """Convert WordPress posts to the target format"""
    posts = []
    category_posts = []
    
    with open(input_file, 'r', encoding='utf-8') as f:
        reader = csv.DictReader(f)
        
        for row in reader:
            # Extract basic fields
            post_id = row.get('post_id', '')
            title = parse_multilingual_field(row.get('post_title', ''))
            content = parse_multilingual_field(row.get('post_content', ''))
            excerpt = parse_multilingual_field(row.get('post_excerpt', ''))
            post_date = row.get('post_date', '')
            featured_image = row.get('featured_image', '')
            
            # Parse date
            published_at = None
            if post_date:
                try:
                    # Try to parse the date (WordPress format)
                    dt = datetime.strptime(post_date, '%Y-%m-%d %H:%M:%S')
                    published_at = dt.strftime('%Y-%m-%d %H:%M:%S')
                except:
                    published_at = None
            
            # Create post record
            post_record = {
                'id': post_id,
                'title': json.dumps(title) if title else '{"id": null}',
                'slug': json.dumps({"id": re.sub(r'[^a-z0-9\-]', '-', title.get('id', '').lower()).strip('-')}) if title.get('id') else '{"id": null}',
                'content': json.dumps(content) if content else '{"id": null}',
                'excerpt': json.dumps(excerpt) if excerpt else '{"id": null}',
                'custom_fields': '{}',
                'featured_image': featured_image if featured_image else 'NULL',
                'gallery': 'NULL',
                'template': 'NULL',
                'menu_order': '0',
                'featured': '0',
                'status': 'published',
                'published_at': published_at,
                'author_id': '1',
                'created_at': published_at if published_at else datetime.now().strftime('%Y-%m-%d %H:%M:%S'),
                'updated_at': datetime.now().strftime('%Y-%m-%d %H:%M:%S'),
                'deleted_at': 'NULL'
            }
            posts.append(post_record)
            
            # Extract categories and create category_post relationships
            categories = extract_categories(row.get('categories', ''))
            for category_id in categories:
                category_posts.append({
                    'post_id': post_id,
                    'category_id': category_id
                })
    
    # Write posts to CSV
    with open(output_file, 'w', encoding='utf-8', newline='') as f:
        fieldnames = ['id', 'title', 'slug', 'content', 'excerpt', 'custom_fields', 
                     'featured_image', 'gallery', 'template', 'menu_order', 'featured', 
                     'status', 'published_at', 'author_id', 'created_at', 'updated_at', 'deleted_at']
        writer = csv.DictWriter(f, fieldnames=fieldnames)
        writer.writeheader()
        writer.writerows(posts)
    
    return category_posts

def write_category_posts(category_posts, output_file):
    """Write category_post relationships to CSV"""
    with open(output_file, 'w', encoding='utf-8', newline='') as f:
        fieldnames = ['post_id', 'category_id']
        writer = csv.DictWriter(f, fieldnames=fieldnames)
        writer.writeheader()
        writer.writerows(category_posts)

if __name__ == "__main__":
    input_file = "../../../Downloads/8p_posts(1).csv"
    posts_output = "converted_posts.csv"
    category_posts_output = "converted_category_post.csv"
    
    print("Converting posts...")
    category_posts = convert_posts(input_file, posts_output)
    
    print("Writing category relationships...")
    write_category_posts(category_posts, category_posts_output)
    
    print(f"Conversion complete. Posts saved to {posts_output}")
    print(f"Category relationships saved to {category_posts_output}")