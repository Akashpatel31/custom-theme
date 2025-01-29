# Parks Theme

**Parks Theme** is a custom WordPress theme designed to manage and display parks using custom post types and taxonomies. The theme features a grid layout for displaying parks, with custom fields for location, hours, and more. The theme also supports custom taxonomies for categorizing parks based on their facilities.

## Features

- **Custom Post Type (Parks)**: Register and display parks as a custom post type.
- **Custom Taxonomy (Facilities)**: Categorize parks by their facilities (e.g., Playground, Restrooms).
- **Custom Fields**: Add and display custom fields like location and hours for each park.
- **Responsive Grid Layout**: Parks are displayed in a flexible, responsive grid on the front-end.
- **Shortcode**: Use the `[parks]` shortcode to display parks on any page or post, with optional filtering by facility.
- **Theme Customization**: Easily extend and customize with custom CSS and JavaScript.

## Installation

1. **Download the Theme**: Download the theme files or clone the repository.
2. **Upload to WordPress**:
   - Navigate to `wp-content/themes` in your WordPress installation.
   - Upload the **Parks Theme** folder (containing the theme files) to this directory.
3. **Activate the Theme**:
   - Go to the WordPress admin dashboard.
   - Navigate to **Appearance > Themes**.
   - Activate the **Parks Theme**.

## Custom Post Type: Parks

- The theme registers a custom post type called **Parks**.
- Each park can have the following custom fields:
  - **Location**: The park's address or coordinates.
  - **Hours (Weekdays)**: The park’s operating hours on weekdays.
  - **Hours (Weekends)**: The park’s operating hours on weekends.
  
You can add and manage parks through the WordPress admin area, just like any other post type.

## Custom Taxonomy: Facilities

- The theme registers a custom taxonomy called **Facilities**, which allows you to categorize parks based on their available amenities (e.g., Playground, Restrooms, Trails).
- You can assign parks to one or more facilities when editing a park post.

## Shortcode: `[parks]`

The `[parks]` shortcode allows you to display parks on any page or post. By default, it will show all parks. You can filter the parks by their facility by adding the `facility` attribute.

Example:
```plaintext
[parks facility="playground"]
