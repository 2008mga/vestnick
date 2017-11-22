import "%/base.scss"
import "~/selectize"
import "./boot";
import { summernoteUploader } from  "./summernote.utils";

(function() {
  require("~/bootstrap/js/src/collapse");
  require("bootstrap/js/src/tooltip");
  require("bootstrap/js/src/modal");
  require("bootstrap/js/src/dropdown");
  require("~/ezdz");
  $('select').selectize();
  $('input[type=file]').ezdz({
    text: 'Нажмите чтобы выбрать файл'
  });

  const Switchery = require('switchery');
  const SwitcheryItems = document.querySelectorAll('.js-switch');

  for (let i = 0; i < SwitcheryItems.length; i++) {
    let item = SwitcheryItems[i];

    new Switchery(item, {
      size: 'small'
    });
  }
  require('summernote');
  $('textarea').summernote({
    toolbar: [
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']],
      ['insert', ['picture', 'link']]
    ],
    callbacks : {
      onImageUpload(image) {
        summernoteUploader(image, '#' + $(this).attr('id'), '/admin/upload/image');
      }
    }
  });

  function getSelectValues(select) {
    let result = [];
    let options = select && select.options;
    let opt;

    for (let i=0, iLen=options.length; i<iLen; i++) {
      opt = options[i];

      if (opt.selected) {
        result.push(opt.value || opt.text);
      }
    }
    return result;
  }
  

  $("#new_form").submit((e) => {
    e.preventDefault();

    const data = {
      'short_name': $('input[name=short_name]').val(),
      'full_name': $('input[name=full_name]').val(),
      'tags': getSelectValues(document.querySelector('select[name="tags[]"]')),
      'display_author': $('input[name=display_author]').is(':checked') ? 1 : 0,
      'is_private': $('input[name=is_private]').is(':checked') ? 1 : 0,
      'text': $('#new_content').summernote('code')
    };
    const $target = $(e.target);
    const isUpdate = $($target).attr('data-method') === 'put';
    const url = $($target).attr('action');

    const client = isUpdate ? axios.put(url, data) : axios.post(url, data);
    const $buttonText = $target.find('button[type=submit]').find('small');

    $buttonText.prop('disabled', true);

    client.then((req) => {
      let url = req.data.url;
      $buttonText.text("Сохранено");

      setTimeout(() => {
        console.log(req.data);
        if (url) {
          window.location.href = url;
        }

        $buttonText.text("");
      }, 2000)
    }).catch((e) => {
      $buttonText.text("Ошибка");
      $buttonText.prop('disabled', false);

      setTimeout(() => {
        $buttonText.text("");
      }, 2000)
      throw e;
    });
  });

  require('bootstrap-colorpicker');
  // color picker
  $('#cp5').colorpicker({
    format: null
  });
})();