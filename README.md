# Local Development Setup

## Quick Start

1. **Install Lando** from https://lando.dev (if you haven't already)

2. **Start the environment:**
   ```bash
   lando start
   ```

3. **Install WordPress:**
   ```bash
   lando install
   ```

4. **Set up the Camelcase Theme for development:**
   ```bash
   cd wp-content/themes/camelcase-theme
   npm install
   npm run dev
   ```

That's it! Your site is now running at: **https://camelcase.lndo.site:4433**

- **Username:** admin
- **Password:** admin
- **Theme:** Camelcase Theme (with HMR enabled)

## What's Included

- PHP 8.2
- MariaDB 10.11
- WordPress latest
- WP-CLI pre-installed
- **Camelcase Theme** with modern development stack:
  - Vite for fast builds and HMR
  - Tailwind CSS 3.x with Epilogue font
  - Alpine.js for JavaScript interactions
  - PostCSS for CSS processing

## Theme Development

### Hot Module Replacement (HMR)
When `npm run dev` is running, the theme automatically enables HMR:
- **CSS changes** update instantly without page refresh
- **JavaScript changes** hot-reload modules
- **PHP file changes** trigger automatic browser refresh

### Build Commands
```bash
cd wp-content/themes/camelcase-theme

# Development with HMR
npm run dev

# Production build
npm run build
```

## Helpful Commands

- `lando wp` - Run any WP-CLI command
- `lando mysql` - Access the database
- `lando info` - Show connection details
- `lando stop` - Stop the environment
- `lando destroy` - Remove containers (start fresh)

## Troubleshooting

### Theme Development Issues

**CSS not loading or HMR not working:**
1. Make sure `npm run dev` is running (Vite dev server on port 3000)
2. Verify `IS_VITE_DEVELOPMENT` is set to `true` in wp-config-local.php
3. Check that WordPress site URL matches: `https://camelcase.lndo.site:4433`

**Build failures:**
- Ensure all config files use ES module syntax (`export default`)
- Check that `"type": "module"` is set in package.json

### General Issues

If you see SSL warnings in your browser, accept the certificate (it's a local cert).

If port conflicts occur, Lando will automatically find available ports. Run `lando info` to see the actual URLs.

**Common ports used:**
- WordPress: `https://camelcase.lndo.site:4433`
- Vite dev server: `http://localhost:3000`

## Database Info (if needed)

- Database: wordpress
- User: wordpress
- Password: wordpress
- Host: database (internally) or localhost:PORT (check `lando info`)

## Development Workflow

1. **Start Lando:** `lando start`
2. **Start theme development:** `cd wp-content/themes/camelcase-theme && npm run dev`
3. **Make changes** to CSS, JS, or PHP files
4. **See instant updates** in your browser
5. **Build for production:** `npm run build` (when ready to deploy)

## Adding Custom Blocks

You have the flexibility to create blocks using ACF (Advanced Custom Fields), Gutenberg blocks, or any other method you prefer. The theme is set up to support multiple approaches.

### Option 1: ACF Blocks (Recommended for Quick Development)

The theme includes ACF integration with example code ready to uncomment.

#### Prerequisites
1. Install and activate the Advanced Custom Fields plugin
2. For production environments, ACF admin is automatically disabled for security/performance (enabled on local)

#### Steps to Add a New ACF Block

1. **Register your block** in `wp-content/themes/camelcase-theme/inc/acf.php`:
   - Uncomment the example block registration (lines 100-108)
   - Modify the block settings:
   ```php
   acf_register_block_type( array(
       'name'              => 'your-block-name',
       'title'             => __( 'Your Block Title', 'camelcase-theme' ),
       'description'       => __( 'Block description here', 'camelcase-theme' ),
       'render_template'   => get_template_directory() . '/template-parts/blocks/your-block.php',
       'category'          => 'formatting',
       'icon'              => 'admin-comments',
       'keywords'          => array( 'keyword1', 'keyword2' ),
   ) );
   ```

2. **Create the block template** at `template-parts/blocks/your-block.php`:
   ```php
   <?php
   /**
    * Your Block Template
    *
    * @param array $block The block settings and attributes.
    * @param string $content The block inner HTML (empty).
    * @param bool $is_preview True during backend preview render.
    * @param int $post_id The post ID the block is rendering content against.
    * @param array $context The context provided to the block by the post or its parent block.
    */

   // Get ACF fields
   $field_name = get_field('field_name') ?: 'Default value';
   ?>

   <div class="your-block-classes">
       <!-- Your block HTML here -->
   </div>
   ```

3. **Configure ACF fields**:
   - Go to Custom Fields → Add New in WordPress admin
   - Create your field group
   - Set location rules to: Block → is equal to → Your Block Name
   - Fields will auto-save to `source/acf-json/` (create this directory if needed)

4. **Style your block** using Tailwind classes in the template

## JavaScript & Alpine.js Integration

### How Alpine.js is Included

Alpine.js is already integrated into the theme and automatically initialized. It's imported in `assets/js/main.js` and starts on page load.

#### Using Alpine.js in Your Blocks

Add Alpine.js directives directly in your PHP templates:

```html
<!-- Example: Toggle functionality -->
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle Content</button>
    <div x-show="open" x-transition>
        Your content here
    </div>
</div>

<!-- Example: Dynamic form -->
<div x-data="{ count: 0 }">
    <button @click="count++">Add Item</button>
    <span x-text="count"></span>
</div>
```

### Adding Custom JavaScript

The theme provides multiple ways to add custom JavaScript functionality:

#### Option 1: Using the /parts Directory (Recommended for Organization)

Create modular JavaScript files in `assets/js/parts/` for better code organization:

1. Create your module in `assets/js/parts/`:
   ```javascript
   // assets/js/parts/custom-slider.js
   export function initSlider() {
       // Your slider logic here
   }
   ```

2. Import and use in `main.js`:
   ```javascript
   import { initSlider } from './parts/custom-slider';

   document.addEventListener('DOMContentLoaded', () => {
       initSlider();
   });
   ```

#### Option 2: Alpine.js Components

Register custom Alpine components for reusable functionality:

```javascript
// assets/js/parts/alpine-components.js
export function registerAlpineComponents() {
    Alpine.data('dropdown', () => ({
        open: false,
        toggle() { this.open = !this.open },
        close() { this.open = false }
    }));
}
```

Then use in your templates:
```html
<div x-data="dropdown">
    <button @click="toggle()">Menu</button>
    <div x-show="open" @click.away="close()">
        <!-- Menu items -->
    </div>
</div>
```

#### Option 3: Vanilla JavaScript

You can also use plain vanilla JavaScript anywhere in the theme:

- Add to `main.js` for global functionality
- Create separate files in `assets/js/parts/`
- Or include directly in your block templates:
  ```php
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      // Your vanilla JS code here
  });
  </script>
  ```

### JavaScript Best Practices

- Use ES6 modules for better organization
- Leverage Alpine.js for interactive UI components (already included)
- Keep block-specific JS with the block when possible
- Use the `/parts` directory for reusable functionality
- All custom JS benefits from Vite's HMR during development
