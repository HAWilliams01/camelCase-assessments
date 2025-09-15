# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

This is a WordPress site configured to run on the Pantheon platform. The codebase follows WordPress's standard structure with Pantheon-specific configurations.

## Key Configuration Files

- **wp-config.php**: Main WordPress configuration that conditionally loads Pantheon settings
- **pantheon.yml**: Site-specific Pantheon configuration overrides
- **pantheon.upstream.yml**: Default Pantheon upstream configuration (PHP 8.2, MariaDB 10.4)

## Development Environment Setup

### Local Development
- Create a `wp-config-local.php` file for local development settings (already in .gitignore)
- The config system automatically detects and loads local settings when not on Pantheon

### Pantheon Environment Detection
The codebase uses `$_ENV['PANTHEON_ENVIRONMENT']` to detect if running on Pantheon platform.

## WordPress Structure

### Core Directories
- **wp-admin/**: WordPress admin interface
- **wp-includes/**: WordPress core files
- **wp-content/**: Themes, plugins, and uploads
  - **themes/**: Contains default WordPress themes (twentynineteen through twentytwentyfive)
  - **plugins/**: WordPress plugins (akismet, hello)
  - **mu-plugins/**: Must-use plugins including Pantheon-specific functionality

### Pantheon Integration
- **wp-content/mu-plugins/pantheon-mu-plugin/**: Pantheon platform integration
- **wp-content/mu-plugins/loader.php**: Loads required Pantheon plugins

## Protected Paths
The following paths are protected by default on Pantheon:
- `/private/`
- `/wp-content/uploads/private/`
- `/xmlrpc.php`

## Branch Strategy
- **master**: Main production branch for customer use
- **default**: Development branch where PRs are merged (includes CI)