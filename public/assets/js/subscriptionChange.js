$(document).ready(function () {
  $("#subscriptionschangeform").bootstrapValidator({
    fields: {
      end_date: {
        validators: {
          notEmpty: {
            message: "A data de término é obrigatória e não pode estar vazia",
          },
        },
      },
      date: {
        validators: {
          notEmpty: {
            message: "A data do cheque é obrigatória e não pode estar vazia",
          },
        },
      },
      number: {
        validators: {
          notEmpty: {
            message: "O número do cheque é obrigatório e não pode estar vazio",
          },
        },
      },
    },
  });
});
