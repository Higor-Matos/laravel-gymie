$(document).ready(function () {
  $(".smstriggers").bootstrapValidator({
    fields: {
      message: {
        validators: {
          notEmpty: {
            message: "O texto da mensagem é obrigatório e não pode estar vazio",
          },
          stringLength: {
            max: 420,
            message: "Deve ter menos de 420 caracteres",
          },
        },
      },
    },
  });
});
