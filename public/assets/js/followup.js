$(document).ready(function () {
  $("#followupform").bootstrapValidator({
    fields: {
      outcome: {
        validators: {
          notEmpty: {
            message: "O resultado é obrigatório e não pode estar vazio",
          },
        },
      },
    },
  });
});
