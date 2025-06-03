#!/bin/bash
PLUGIN_SLUG="adams-yardsmart-api"
VERSION=$(jq -r .version package.json)

BUILD_DIR="./release"
ZIP_NAME="$PLUGIN_SLUG-$VERSION.zip"

# Clean old build
rm -rf "$BUILD_DIR"
mkdir "$BUILD_DIR"

# Copy plugin files (exclude unwanted files)
rsync -av --exclude='.git*' \
          --exclude='node_modules' \
          --exclude='release' \
          --exclude='*.zip' \
          --exclude='.*' \
          --exclude='tests' \
          --exclude='*.md' \
          --exclude 'release.sh' \
          --exclude 'package-lock.json' \
          --exclude 'package.json' \
          --exclude 'eslint.config.mjs' \
          --exclude 'api-log.txt' \
          --exclude 'parts.json' \
          --exclude 'vehicles.json' \
          ./ "$BUILD_DIR/$PLUGIN_SLUG"

# Create zip
cd "$BUILD_DIR"
zip -r "$ZIP_NAME" "$PLUGIN_SLUG"
cd -

echo "Release created at: $BUILD_DIR/$ZIP_NAME"
