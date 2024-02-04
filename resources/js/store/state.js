// Initial Setting State
export const initialState = {
  "saveLocal": "sessionStorage",
  "storeKey": "frekza-setting",
  "setting": {
    "app_name": {
      "value": "Frezka"
    },
    "theme_scheme_direction": {
      "value": "ltr"
    },
    "theme_scheme": {
      "value": "light"
    },
    "theme_style_appearance": {
      "value": [
        "theme-default"
      ]
    },
    "theme_color": {
      "colors": {
        "--{{prefix}}primary": "#19235A",
        "--{{prefix}}info": "#08B1BA",
      },
      "value": "theme-color-default"
    },
    "theme_transition": {
      "value": "theme-with-animation"
    },
    "theme_font_size": {
      "value": "theme-fs-md"
    },
    "page_layout": {
      "value": "container-fluid"
    },
    "header_navbar": {
      "value": "navs-default"
    },
    "header_banner": {
      "value": "default"
    },
    "sidebar_color": {
      "value": "sidebar-white"
    },
    "sidebar_type": {
      "value": []
    },
    "sidebar_show": {
      "value":"sidebar"
    },
    "navbar_show": {
      "value": "iq-navbar",
    },
    "sidebar_menu_style": {
      "value": "left-bordered"
    },
    "card_style": {
      "value": "card-default"
    },
    "footer_style": {
      "value": "default"
    },
    "body_font_family": {
      "value": null
    },
    "heading_font_family": {
      "value": null
    }
  }
};

// Default Setting State
export const defaultState = {
  "saveLocal": "sessionStorage",
  "storeKey": "frekza-setting",
  "setting": {
    app_name: {
      target: '[data-setting="app_name"]',
      choices: [],
      type: "text",
      value: "Frezka",
    },
    theme_scheme_direction: {
      target: "html",
      choices: ["ltr", "rtl"],
      type: "layout_design",
      value: "ltr",
    },
    theme_scheme: {
      target: "body",
      choices: ["light", "dark", "auto"],
      type: "layout_design",
      value: "light",
    },
    theme_style_appearance: {
      target: "body",
      choices: [
        "theme-default",
        "theme-flat",
        "theme-bordered",
        "theme-sharp",
      ],
      type: "layout_design",
      value: ["theme-default"],
    },
    theme_color: {
      target: "body",
      choices: [
        "theme-color-blue",
        "theme-color-gray",
        "theme-color-red",
        "theme-color-yellow",
        "theme-color-pink",
        "theme-color-default",
      ],
      type: "default",
      colors: {
        "--{{prefix}}primary": "#19235A",
        "--{{prefix}}info": "#08B1BA",
      },
      value: "theme-color-default",
    },
    theme_transition: {
      target: "body",
      choices: ["theme-without-animation", "theme-with-animation"],
      type: "layout_design",
      value: "theme-with-animation",
    },
    theme_font_size: {
      target: "html",
      choices: ["theme-fs-sm", "theme-fs-md", "theme-fs-lg"],
      type: "layout_design",
      value: "theme-fs-md",
    },
    page_layout: {
      target: "#page_layout",
      choices: ["container", "container-fluid"],
      type: "layout_design",
      value: "container-fluid",
    },
    header_navbar: {
      target: ".iq-navbar",
      choices: [
        "default",
        "fixed",
        "navs-sticky",
        "nav-glass",
        "navs-transparent",
        "boxed",
        "hidden",
      ],
      type: "layout_design",
      value: "navs-default",
    },
    header_banner: {
      target: ".iq-banner",
      choices: ["default", "navs-bg-color", "hide"],
      type: "layout_design",
      value: "default",
    },
    sidebar_color: {
      target: '[data-toggle="main-sidebar"]',
      choices: [
        "sidebar-white",
        "sidebar-dark",
        "sidebar-color",
        "sidebar-transparent",
        "sidebar-glass"
      ],
      type: "layout_design",
      value: "sidebar-white",
    },
    sidebar_type: {
      target: '[data-toggle="main-sidebar"]',
      choices: ["sidebar-hover", "sidebar-mini", "sidebar-boxed", "sidebar-soft"],
      type: "layout_design",
      value: [],
    },
    sidebar_show: {
      target: '[data-toggle="main-sidebar"]',
      choices: ["sidebar-none", "sidebar"],
      type: "defaultChecked",
      value: 'sidebar',
    },
    navbar_show: {
          target: '.navbar',
          choices: ["iq-navbar-none","iq-navbar"],
          type: "defaultChecked",
          value: 'iq-navbar',
        },
    sidebar_menu_style: {
      target: '[data-toggle="main-sidebar"]',
      choices: [
        "sidebar-default navs-rounded",
        "sidebar-default navs-rounded-all",
        "sidebar-default navs-pill",
        "sidebar-default navs-pill-all",
        "left-bordered",
        "sidebar-default navs-full-width"
      ],
      type: "layout_design",
      value: "left-bordered",
    },
    card_style: {
      target: "body",
      choices: ["card-default", "card-glass", "card-transparent" ],
      type: "layout_design",
      value: "card-default"
    },
    footer_style: {
      target: "footer",
      choices: ["sticky", "default", "glass"],
      type: "layout_design",
      value: "default",
    },
    body_font_family: {
      target: "body",
      choices: [],
      type: "variable",
      value: "Inter",
    },
    heading_font_family: {
      target: "heading",
      choices: [],
      type: "variable",
      value: "Inter",
    },
  }
}
