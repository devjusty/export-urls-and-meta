import js from "@eslint/js";
import globals from "globals";
import wordpress from "@wordpress/eslint-plugin";
import { defineConfig } from "eslint/config";

export default defineConfig([
  {
    files: ["**/*.{js,mjs,cjs}"],
    languageOptions: {
      sourceType: "commonjs",
      globals: globals.browser,
    },
    plugins: {
      js,
      "@wordpress": wordpress,
    },
    rules: {
      ...wordpress.configs["recommended-with-formatting"].rules,
    },
  },
]);
