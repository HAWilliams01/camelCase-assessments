# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

This is a WordPress site configured for local development. The codebase follows WordPress's standard structure.

## Key Configuration Files

- **wp-config.php**: Main WordPress configuration that conditionally loads local settings

## Development Environment Setup

### Local Development
- Create a `wp-config-local.php` file for local development settings (already in .gitignore)
- The config system automatically detects and loads local settings

## WordPress Structure

### Core Directories
- **wp-admin/**: WordPress admin interface
- **wp-includes/**: WordPress core files
- **wp-content/**: Themes, plugins, and uploads
  - **themes/**: Contains default WordPress themes (twentynineteen through twentytwentyfive)
  - **plugins/**: WordPress plugins (akismet, hello)
  - **mu-plugins/**: Must-use plugins

## Branch Strategy
- **main**: Main production branch for development and deployment