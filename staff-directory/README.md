# Staff Directory WordPress Plugin

A comprehensive WordPress plugin for managing staff members with Advanced Custom Fields Pro integration.

## Features

- **Custom Post Type**: Dedicated 'staff' post type with menu order support
- **ACF Pro Integration**: Rich field groups for staff information and social media
- **Flexible Shortcode**: `[staff_directory]` with multiple sorting and display options
- **Single Staff Pages**: Custom template for individual staff member profiles
- **Responsive Design**: Mobile-friendly card/grid layouts
- **Department Organization**: Built-in department taxonomy and filtering

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Advanced Custom Fields Pro plugin

## Installation

1. Upload the `staff-directory` folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Ensure ACF Pro is installed and activated
4. Start adding staff members through the WordPress admin

## Usage

### Adding Staff Members

1. Go to **Staff Directory > Add New Staff Member** in your WordPress admin
2. Fill in the staff information fields:
   - Full Name
   - Job Title
   - Email Address
   - Phone Number (optional)
   - Birth Date (optional)
   - Department
   - Biography
   - Social Media Links
3. Set a featured image for the staff photo
4. Use the **Order** field in Page Attributes to control display order
5. Publish the staff member

### Displaying Staff Directory

Use the `[staff_directory]` shortcode in any post, page, or widget to display your staff members.

#### Shortcode Parameters

```
[staff_directory orderby="menu_order" columns="3" limit="12" department="marketing"]
```

**Available Parameters:**

- `orderby`: How to sort staff members
  - `menu_order` (default) - Use the order set in admin
  - `alphabetical` - Sort by name A-Z
  - `department` - Group by department
- `columns`: Number of columns in grid (1-6, default: 3)
- `limit`: Number of staff to display (-1 for all, default: -1)
- `department`: Filter by specific department slug

#### Example Shortcodes

```html
<!-- Default 3-column grid, menu order -->
[staff_directory]

<!-- 4-column grid, alphabetical order -->
[staff_directory orderby="alphabetical" columns="4"]

<!-- Show only marketing department -->
[staff_directory department="marketing"]

<!-- 2-column grid, limit to 6 staff members -->
[staff_directory columns="2" limit="6"]
```

### Single Staff Pages

Each staff member automatically gets their own page displaying:

- Staff photo
- Full contact information
- Biography and additional content
- Social media links
- Back to directory navigation

URLs follow the pattern: `yoursite.com/staff/staff-member-name/`

## Staff Fields

The plugin creates the following fields for each staff member:

### Basic Information
- **Full Name** (required)
- **Job Title** (required)
- **Email Address** (required)
- **Phone Number**
- **Birth Date**
- **Department** (dropdown)
- **Biography** (textarea)

### Social Media
- **Social Links** (repeater field)
  - Platform (LinkedIn, Twitter, Facebook, Instagram, GitHub, etc.)
  - URL

## Departments

Available departments include:
- Executive
- Marketing
- Sales
- Human Resources
- Information Technology
- Finance
- Operations
- Customer Service
- Other

## Customization

### Theme Integration

The plugin uses its own templates but respects your theme's styling. You can override the single staff template by copying `single-staff.php` to your theme directory.

### CSS Customization

The plugin includes comprehensive CSS that can be customized through:
- Theme's `style.css`
- WordPress Customizer
- Custom CSS plugins

Key CSS classes:
- `.staff-directory-container` - Main container
- `.staff-directory-grid` - Grid wrapper
- `.staff-directory-card` - Individual staff cards
- `.staff-single-container` - Single page wrapper

## File Structure

```
staff-directory/
├── staff-directory.php              # Main plugin file
├── includes/
│   ├── class-staff-post-type.php    # Post type registration
│   ├── class-staff-acf-fields.php   # ACF field groups
│   ├── class-staff-shortcode.php    # Shortcode handler
│   └── class-staff-templates.php    # Template loader
├── templates/
│   └── single-staff.php             # Single staff template
├── assets/
│   └── css/
│       └── staff-directory.css      # Frontend styles
└── README.md                        # Documentation
```

## Support

For support and feature requests, please use the GitHub repository issues page.

## Changelog

### Version 1.0.0
- Initial release
- Custom staff post type
- ACF Pro integration
- Flexible shortcode with sorting options
- Responsive design
- Single staff page templates
- Department organization

## License

GPL v2 or later