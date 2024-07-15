$(document).ready(function () {
  $("#settingsform").bootstrapValidator({
    fields: {
      primary_contact: {
        validators: {
          regexp: {
            regexp: /^[0-9\.]+$/,
            message: "A entrada não é um número válido",
          },
          stringLength: {
            max: 10,
            message: "Deve ter menos de 10 caracteres",
          },
        },
      },
    },
  });
});
