(function ($) {
  'use strict';
  $.contextMenu({
    selector: '#context-menu-simple',
    callback: function (key, options) {},
    items: {
      "edit": {
        name: "ویرایش",
        icon: "edit"
      },
      "cut": {
        name: "بریدن",
        icon: "cut"
      },
      copy: {
        name: "کپی",
        icon: "copy"
      },
      "paste": {
        name: "چسباندن",
        icon: "paste"
      },
      "delete": {
        name: "حذف",
        icon: "delete"
      },
      "sep1": "---------",
      "quit": {
        name: "خروج",
        icon: function () {
          return 'context-menu-icon context-menu-icon-quit';
        }
      }
    }
  });
  $.contextMenu({
    selector: '#context-menu-access',
    callback: function (key, options) {
      var m = "clicked: " + key;
      window.console && console.log(m) || alert(m);
    },
    items: {
      "edit": {
        name: "ویرایش",
        icon: "edit",
        accesskey: "e"
      },
      "cut": {
        name: "بریدن",
        icon: "cut",
        accesskey: "c"
      },
      // first unused character is taken (here: o)
      "copy": {
        name: "کپی",
        icon: "copy",
        accesskey: "c o p y"
      },
      // words are truncated to their first letter (here: p)
      "paste": {
        name: "چسباندن",
        icon: "paste",
        accesskey: "cool paste"
      },
      "delete": {
        name: "حذف",
        icon: "delete"
      },
      "sep1": "---------",
      "quit": {
        name: "خروج",
        icon: function ($element, key, item) {
          return 'context-menu-icon context-menu-icon-quit';
        }
      }
    }
  });
  $.contextMenu({
    selector: '#context-menu-open',
    callback: function (key, options) {
      var m = "clicked: " + key;
      window.console && console.log(m) || alert(m);
    },
    items: {
      "edit": {
        name: "بستن با کلیک",
        icon: "delete",
        callback: function () {
          return true;
        }
      },
      "cut": {
        name: "باز نگه داشتن با کلیک",
        icon: "edit",
        callback: function () {
          return false;
        }
      }
    }
  });
  $.contextMenu({
    selector: '#context-menu-multi',
    callback: function (key, options) {
      var m = "clicked: " + key;
      window.console && console.log(m) || alert(m);
    },
    items: {
      "edit": {
        "name": "ویرایش",
        "icon": "edit"
      },
      "cut": {
        "name": "بریدن",
        "icon": "cut"
      },
      "sep1": "---------",
      "quit": {
        "name": "خروج",
        "icon": "quit"
      },
      "sep2": "---------",
      "fold1": {
        "name": "زیر گروه 1",
        "items": {
          "fold1-key1": {
            "name": "زیر گروه 1-1"
          },
          "fold2": {
            "name": "زیرگروه 2",
            "items": {
              "fold2-key1": {
                "name": "زیرگروه 1-2"
              },
              "fold2-key2": {
                "name": "زیرگروه 2-2"
              },
              "fold2-key3": {
                "name": "زیرگروه 3-2"
              }
            }
          },
          "fold1-key3": {
            "name": "زیرگروه 3"
          }
        }
      },
      "fold1a": {
        "name": "زیرگروه 4",
        "items": {
          "fold1a-key1": {
            "name": "زیرگروه 1-4"
          },
          "fold1a-key2": {
            "name": "زیرگروه 2-4"
          },
          "fold1a-key3": {
            "name": "زیرگروه3-4"
          }
        }
      }
    }
  });
  $.contextMenu({
    selector: '#context-menu-hover',
    trigger: 'hover',
    delay: 500,
    callback: function (key, options) {
      var m = "clicked: " + key;
      window.console && console.log(m) || alert(m);
    },
    items: {
      "edit": {
        name: "ویرایش",
        icon: "edit"
      },
      "cut": {
        name: "بریدن",
        icon: "cut"
      },
      "copy": {
        name: "کپی",
        icon: "copy"
      },
      "paste": {
        name: "چسباندن",
        icon: "paste"
      },
      "delete": {
        name: "حذف",
        icon: "delete"
      },
      "sep1": "---------",
      "quit": {
        name: "خروج",
        icon: function ($element, key, item) {
          return 'context-menu-icon context-menu-icon-quit';
        }
      }
    }
  });
  $.contextMenu({
    selector: '#context-menu-hover-autohide',
    trigger: 'hover',
    delay: 500,
    autoHide: true,
    callback: function (key, options) {
      var m = "clicked: " + key;
      window.console && console.log(m) || alert(m);
    },
    items: {
      "edit": {
        name: "ویرایش",
        icon: "edit"
      },
      "cut": {
        name: "بریدن",
        icon: "cut"
      },
      "copy": {
        name: "کپی",
        icon: "copy"
      },
      "paste": {
        name: "چسباندن",
        icon: "paste"
      },
      "delete": {
        name: "حذف",
        icon: "delete"
      },
      "sep1": "---------",
      "quit": {
        name: "خروج",
        icon: function ($element, key, item) {
          return 'context-menu-icon context-menu-icon-quit';
        }
      }
    }
  });
})(jQuery);