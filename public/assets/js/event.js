$(document).ready(function () {
  $("#smseventsform").bootstrapValidator({
    fields: {
      date: {
        validators: {
          notEmpty: {
            message: "A data do evento é obrigatória e não pode estar vazia",
          },
        },
      },
      name: {
        validators: {
          notEmpty: {
            message: "O nome é obrigatório e não pode estar vazio",
          },
          stringLength: {
            max: 50,
            message: "Deve ter menos de 50 caracteres",
          },
        },
      },
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
