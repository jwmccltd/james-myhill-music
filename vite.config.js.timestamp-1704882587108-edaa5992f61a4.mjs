// vite.config.js
import { defineConfig } from "file:///home/vagrant/code/jwm/node_modules/vite/dist/node/index.js";
import laravel from "file:///home/vagrant/code/jwm/node_modules/laravel-vite-plugin/dist/index.mjs";
import path from "path";
import vue from "file:///home/vagrant/code/jwm/node_modules/@vitejs/plugin-vue/dist/index.mjs";
var __vite_injected_original_dirname = "/home/vagrant/code/jwm";
var vite_config_default = defineConfig({
  server: {
    hmr: {
      host: "jwm-new.test"
    },
    host: "jwm-new.test",
    watch: {
      usePolling: true
    }
  },
  plugins: [
    vue({
      template: {
        transformAssetUrls: {
          // The Vue plugin will re-write asset URLs, when referenced
          // in Single File Components, to point to the Laravel web
          // server. Setting this to `null` allows the Laravel plugin
          // to instead re-write asset URLs to point to the Vite
          // server instead.
          base: null,
          // The Vue plugin will parse absolute URLs and treat them
          // as absolute paths to files on disk. Setting this to
          // `false` will leave absolute URLs un-touched so they can
          // reference assets in the public directory as expected.
          includeAbsolute: false
        }
      }
    }),
    laravel({
      input: ["resources/scss/app.scss", "resources/js/app.js"],
      refresh: true
    })
  ],
  resolve: {
    alias: {
      "~bootstrap": path.resolve(__vite_injected_original_dirname, "node_modules/bootstrap")
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCIvaG9tZS92YWdyYW50L2NvZGUvandtXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCIvaG9tZS92YWdyYW50L2NvZGUvandtL3ZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9ob21lL3ZhZ3JhbnQvY29kZS9qd20vdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tICd2aXRlJztcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xuaW1wb3J0IHBhdGggZnJvbSAncGF0aCc7XG5pbXBvcnQgdnVlIGZyb20gJ0B2aXRlanMvcGx1Z2luLXZ1ZSdcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgICBzZXJ2ZXI6IHtcbiAgICAgICAgaG1yOiB7XG4gICAgICAgICAgaG9zdDogXCJqd20tbmV3LnRlc3RcIixcbiAgICAgICAgfSxcbiAgICAgICAgaG9zdDogXCJqd20tbmV3LnRlc3RcIixcbiAgICAgICAgd2F0Y2g6IHtcbiAgICAgICAgICB1c2VQb2xsaW5nOiB0cnVlLFxuICAgICAgICB9LFxuICAgIH0sXG4gICAgcGx1Z2luczogW1xuICAgICAgICB2dWUoe1xuICAgICAgICAgICAgdGVtcGxhdGU6IHtcbiAgICAgICAgICAgICAgICB0cmFuc2Zvcm1Bc3NldFVybHM6IHtcbiAgICAgICAgICAgICAgICAgICAgLy8gVGhlIFZ1ZSBwbHVnaW4gd2lsbCByZS13cml0ZSBhc3NldCBVUkxzLCB3aGVuIHJlZmVyZW5jZWRcbiAgICAgICAgICAgICAgICAgICAgLy8gaW4gU2luZ2xlIEZpbGUgQ29tcG9uZW50cywgdG8gcG9pbnQgdG8gdGhlIExhcmF2ZWwgd2ViXG4gICAgICAgICAgICAgICAgICAgIC8vIHNlcnZlci4gU2V0dGluZyB0aGlzIHRvIGBudWxsYCBhbGxvd3MgdGhlIExhcmF2ZWwgcGx1Z2luXG4gICAgICAgICAgICAgICAgICAgIC8vIHRvIGluc3RlYWQgcmUtd3JpdGUgYXNzZXQgVVJMcyB0byBwb2ludCB0byB0aGUgVml0ZVxuICAgICAgICAgICAgICAgICAgICAvLyBzZXJ2ZXIgaW5zdGVhZC5cbiAgICAgICAgICAgICAgICAgICAgYmFzZTogbnVsbCxcbiBcbiAgICAgICAgICAgICAgICAgICAgLy8gVGhlIFZ1ZSBwbHVnaW4gd2lsbCBwYXJzZSBhYnNvbHV0ZSBVUkxzIGFuZCB0cmVhdCB0aGVtXG4gICAgICAgICAgICAgICAgICAgIC8vIGFzIGFic29sdXRlIHBhdGhzIHRvIGZpbGVzIG9uIGRpc2suIFNldHRpbmcgdGhpcyB0b1xuICAgICAgICAgICAgICAgICAgICAvLyBgZmFsc2VgIHdpbGwgbGVhdmUgYWJzb2x1dGUgVVJMcyB1bi10b3VjaGVkIHNvIHRoZXkgY2FuXG4gICAgICAgICAgICAgICAgICAgIC8vIHJlZmVyZW5jZSBhc3NldHMgaW4gdGhlIHB1YmxpYyBkaXJlY3RvcnkgYXMgZXhwZWN0ZWQuXG4gICAgICAgICAgICAgICAgICAgIGluY2x1ZGVBYnNvbHV0ZTogZmFsc2UsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH0pLFxuICAgICAgICBsYXJhdmVsKHtcbiAgICAgICAgICAgIGlucHV0OiBbJ3Jlc291cmNlcy9zY3NzL2FwcC5zY3NzJywgJ3Jlc291cmNlcy9qcy9hcHAuanMnXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgIF0sXG4gICAgcmVzb2x2ZToge1xuICAgICAgICBhbGlhczoge1xuICAgICAgICAgICAgJ35ib290c3RyYXAnOiBwYXRoLnJlc29sdmUoX19kaXJuYW1lLCAnbm9kZV9tb2R1bGVzL2Jvb3RzdHJhcCcpLFxuICAgICAgICB9XG4gICAgfSxcbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUFvUCxTQUFTLG9CQUFvQjtBQUNqUixPQUFPLGFBQWE7QUFDcEIsT0FBTyxVQUFVO0FBQ2pCLE9BQU8sU0FBUztBQUhoQixJQUFNLG1DQUFtQztBQUt6QyxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixRQUFRO0FBQUEsSUFDSixLQUFLO0FBQUEsTUFDSCxNQUFNO0FBQUEsSUFDUjtBQUFBLElBQ0EsTUFBTTtBQUFBLElBQ04sT0FBTztBQUFBLE1BQ0wsWUFBWTtBQUFBLElBQ2Q7QUFBQSxFQUNKO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxJQUFJO0FBQUEsTUFDQSxVQUFVO0FBQUEsUUFDTixvQkFBb0I7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsVUFNaEIsTUFBTTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsVUFNTixpQkFBaUI7QUFBQSxRQUNyQjtBQUFBLE1BQ0o7QUFBQSxJQUNKLENBQUM7QUFBQSxJQUNELFFBQVE7QUFBQSxNQUNKLE9BQU8sQ0FBQywyQkFBMkIscUJBQXFCO0FBQUEsTUFDeEQsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLEVBQ0w7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNMLE9BQU87QUFBQSxNQUNILGNBQWMsS0FBSyxRQUFRLGtDQUFXLHdCQUF3QjtBQUFBLElBQ2xFO0FBQUEsRUFDSjtBQUNKLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
