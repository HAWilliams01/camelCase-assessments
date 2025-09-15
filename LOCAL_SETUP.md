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