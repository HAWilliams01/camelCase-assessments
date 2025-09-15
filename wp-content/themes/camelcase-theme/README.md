# Camelcase WordPress Theme

A modern WordPress theme with Vite, Tailwind CSS, and hot module replacement (HMR) support for rapid development.

## Features

- **Vite** - Lightning fast builds and HMR
- **Tailwind CSS** - Utility-first CSS framework
- **Modern Build Tools** - ES6+, SASS/SCSS support
- **Hot Module Replacement** - See changes instantly during development
- **Responsive Design** - Mobile-first approach
- **Accessibility Ready** - WCAG compliant markup
- **WordPress Best Practices** - Following WordPress coding standards

## Requirements

- WordPress 5.9+
- PHP 7.4+
- Node.js 16+
- npm or yarn

## Installation

1. **Clone or download the theme** into your WordPress themes directory:
   ```bash
   cd wp-content/themes/
   git clone [repository-url] camelcase-theme
   ```

2. **Install dependencies**:
   ```bash
   cd camelcase-theme
   npm install
   ```

3. **Activate the theme** in WordPress admin panel

## Development

### Local Development with Vite

1. **Start the development server**:
   ```bash
   npm run dev
   ```
   This will start Vite dev server on http://localhost:3000 with HMR enabled.

2. **Visit your WordPress site** (e.g., https://camelcase.lndo.site:4433/)
   - CSS and JS changes will hot-reload automatically
   - PHP changes require a page refresh

### Building for Production

1. **Build the assets**:
   ```bash
   npm run build
   ```
   This will:
   - Compile and minify CSS/JS
   - Generate source maps
   - Output files to `/dist` directory
   - Create a manifest file for cache busting

2. **Deploy the theme** with the built files

## Project Structure

```
camelcase-theme/
├── assets/
│   ├── css/
│   │   └── main.scss       # Main stylesheet with Tailwind imports
│   └── js/
│       └── main.js         # Main JavaScript file
├── dist/                   # Built files (gitignored)
├── inc/
│   └── vite.php           # Vite integration for WordPress
├── node_modules/           # Dependencies (gitignored)
├── footer.php             # Footer template
├── functions.php          # Theme functions and setup
├── header.php             # Header template
├── index.php              # Main template
├── page.php               # Page template
├── single.php             # Single post template
├── style.css              # Theme info (required by WordPress)
├── package.json           # Node dependencies
├── postcss.config.js      # PostCSS configuration
├── tailwind.config.js     # Tailwind CSS configuration
├── vite.config.js         # Vite configuration
└── README.md              # This file
```

## Configuration

### Tailwind CSS

Edit `tailwind.config.js` to customize:
- Colors
- Fonts
- Breakpoints
- Container sizes
- Custom utilities

### Vite

Edit `vite.config.js` to modify:
- Build paths
- Dev server settings
- Entry points

## Available Scripts

- `npm run dev` - Start Vite development server with HMR
- `npm run build` - Build for production
- `npm run preview` - Preview production build locally

## Working with Lando

If you're using Lando for local development:

1. The theme is configured to work with the default Lando WordPress setup
2. Make sure your `wp-config-local.php` has the correct URLs with ports
3. Vite dev server runs on your host machine, not inside Lando

## Customization

### Adding New Templates

1. Create new PHP template files in the theme root
2. Follow WordPress template hierarchy
3. Use get_header() and get_footer() to include common parts

### Styling with Tailwind

1. Use Tailwind utility classes directly in PHP templates
2. Add custom styles in `assets/css/main.scss`
3. Configure Tailwind in `tailwind.config.js`

### JavaScript

1. Add JavaScript to `assets/js/main.js`
2. Import additional modules as needed
3. Vite will handle bundling automatically

## Troubleshooting

### Vite Dev Server Not Connecting

1. Check if port 3000 is available
2. Ensure WordPress debug mode is enabled for development
3. Check browser console for errors

### Styles Not Loading

1. Run `npm run build` to generate production files
2. Check if `/dist` directory exists with built files
3. Clear browser cache

### Changes Not Reflecting

1. For CSS/JS: Ensure Vite dev server is running
2. For PHP: Refresh the page manually
3. Clear WordPress cache if using caching plugins

## Production Deployment

1. Run `npm run build` locally
2. Commit the `/dist` directory (or build on deployment)
3. Upload theme files to production server
4. Ensure production server has correct PHP version

## Browser Support

- Chrome (last 2 versions)
- Firefox (last 2 versions)
- Safari (last 2 versions)
- Edge (last 2 versions)

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

GPL v2 or later (WordPress compatible)

## Support

For issues and questions, please create an issue in the repository.