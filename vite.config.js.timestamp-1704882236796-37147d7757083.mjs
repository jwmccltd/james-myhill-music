// vite.config.js
import { defineConfig } from "file:///home/vagrant/code/jwm/node_modules/vite/dist/node/index.js";
import laravel from "file:///home/vagrant/code/jwm/node_modules/laravel-vite-plugin/dist/index.mjs";
import path from "path";
import vue from "file:///home/vagrant/code/jwm/node_modules/@vitejs/plugin-vue/dist/index.mjs";
var __vite_injected_original_dirname = "/home/vagrant/code/jwm";
var vite_config_default = defineConfig({
  server: {
    hmr: {
      host: "192.168.56.56"
    },
    host: "192.168.56.56",
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
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCIvaG9tZS92YWdyYW50L2NvZGUvandtXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCIvaG9tZS92YWdyYW50L2NvZGUvandtL3ZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9ob21lL3ZhZ3JhbnQvY29kZS9qd20vdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tICd2aXRlJztcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xuaW1wb3J0IHBhdGggZnJvbSAncGF0aCc7XG5pbXBvcnQgdnVlIGZyb20gJ0B2aXRlanMvcGx1Z2luLXZ1ZSdcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgICBzZXJ2ZXI6IHtcbiAgICAgICAgaG1yOiB7XG4gICAgICAgICAgaG9zdDogXCIxOTIuMTY4LjU2LjU2XCIsXG4gICAgICAgIH0sXG4gICAgICAgIGhvc3Q6IFwiMTkyLjE2OC41Ni41NlwiLFxuICAgICAgICB3YXRjaDoge1xuICAgICAgICAgIHVzZVBvbGxpbmc6IHRydWUsXG4gICAgICAgIH0sXG4gICAgfSxcbiAgICBwbHVnaW5zOiBbXG4gICAgICAgIHZ1ZSh7XG4gICAgICAgICAgICB0ZW1wbGF0ZToge1xuICAgICAgICAgICAgICAgIHRyYW5zZm9ybUFzc2V0VXJsczoge1xuICAgICAgICAgICAgICAgICAgICAvLyBUaGUgVnVlIHBsdWdpbiB3aWxsIHJlLXdyaXRlIGFzc2V0IFVSTHMsIHdoZW4gcmVmZXJlbmNlZFxuICAgICAgICAgICAgICAgICAgICAvLyBpbiBTaW5nbGUgRmlsZSBDb21wb25lbnRzLCB0byBwb2ludCB0byB0aGUgTGFyYXZlbCB3ZWJcbiAgICAgICAgICAgICAgICAgICAgLy8gc2VydmVyLiBTZXR0aW5nIHRoaXMgdG8gYG51bGxgIGFsbG93cyB0aGUgTGFyYXZlbCBwbHVnaW5cbiAgICAgICAgICAgICAgICAgICAgLy8gdG8gaW5zdGVhZCByZS13cml0ZSBhc3NldCBVUkxzIHRvIHBvaW50IHRvIHRoZSBWaXRlXG4gICAgICAgICAgICAgICAgICAgIC8vIHNlcnZlciBpbnN0ZWFkLlxuICAgICAgICAgICAgICAgICAgICBiYXNlOiBudWxsLFxuIFxuICAgICAgICAgICAgICAgICAgICAvLyBUaGUgVnVlIHBsdWdpbiB3aWxsIHBhcnNlIGFic29sdXRlIFVSTHMgYW5kIHRyZWF0IHRoZW1cbiAgICAgICAgICAgICAgICAgICAgLy8gYXMgYWJzb2x1dGUgcGF0aHMgdG8gZmlsZXMgb24gZGlzay4gU2V0dGluZyB0aGlzIHRvXG4gICAgICAgICAgICAgICAgICAgIC8vIGBmYWxzZWAgd2lsbCBsZWF2ZSBhYnNvbHV0ZSBVUkxzIHVuLXRvdWNoZWQgc28gdGhleSBjYW5cbiAgICAgICAgICAgICAgICAgICAgLy8gcmVmZXJlbmNlIGFzc2V0cyBpbiB0aGUgcHVibGljIGRpcmVjdG9yeSBhcyBleHBlY3RlZC5cbiAgICAgICAgICAgICAgICAgICAgaW5jbHVkZUFic29sdXRlOiBmYWxzZSxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfSksXG4gICAgICAgIGxhcmF2ZWwoe1xuICAgICAgICAgICAgaW5wdXQ6IFsncmVzb3VyY2VzL3Njc3MvYXBwLnNjc3MnLCAncmVzb3VyY2VzL2pzL2FwcC5qcyddLFxuICAgICAgICAgICAgcmVmcmVzaDogdHJ1ZSxcbiAgICAgICAgfSksXG4gICAgXSxcbiAgICByZXNvbHZlOiB7XG4gICAgICAgIGFsaWFzOiB7XG4gICAgICAgICAgICAnfmJvb3RzdHJhcCc6IHBhdGgucmVzb2x2ZShfX2Rpcm5hbWUsICdub2RlX21vZHVsZXMvYm9vdHN0cmFwJyksXG4gICAgICAgIH1cbiAgICB9LFxufSk7XG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQW9QLFNBQVMsb0JBQW9CO0FBQ2pSLE9BQU8sYUFBYTtBQUNwQixPQUFPLFVBQVU7QUFDakIsT0FBTyxTQUFTO0FBSGhCLElBQU0sbUNBQW1DO0FBS3pDLElBQU8sc0JBQVEsYUFBYTtBQUFBLEVBQ3hCLFFBQVE7QUFBQSxJQUNKLEtBQUs7QUFBQSxNQUNILE1BQU07QUFBQSxJQUNSO0FBQUEsSUFDQSxNQUFNO0FBQUEsSUFDTixPQUFPO0FBQUEsTUFDTCxZQUFZO0FBQUEsSUFDZDtBQUFBLEVBQ0o7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNMLElBQUk7QUFBQSxNQUNBLFVBQVU7QUFBQSxRQUNOLG9CQUFvQjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxVQU1oQixNQUFNO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxVQU1OLGlCQUFpQjtBQUFBLFFBQ3JCO0FBQUEsTUFDSjtBQUFBLElBQ0osQ0FBQztBQUFBLElBQ0QsUUFBUTtBQUFBLE1BQ0osT0FBTyxDQUFDLDJCQUEyQixxQkFBcUI7QUFBQSxNQUN4RCxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsRUFDTDtBQUFBLEVBQ0EsU0FBUztBQUFBLElBQ0wsT0FBTztBQUFBLE1BQ0gsY0FBYyxLQUFLLFFBQVEsa0NBQVcsd0JBQXdCO0FBQUEsSUFDbEU7QUFBQSxFQUNKO0FBQ0osQ0FBQzsiLAogICJuYW1lcyI6IFtdCn0K
