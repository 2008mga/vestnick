import "%/base.scss"
import "~/selectize"
import "~/selectize/dist/css/selectize.css"
import "~/ezdz/src/jquery.ezdz.css";
window.$ = window.jQuery = require('jquery');

(function() {
  require("~/bootstrap/js/src/collapse");
  require("~/ezdz");
  $('select').selectize();
  $('input[type=file]').ezdz({
    text: 'Нажмите чтобы выбрать файл'
  });
})();