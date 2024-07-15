$(document).ready(function () {
  $("#paymentsform").bootstrapValidator({
    fields: {
      payment_amount: {
        validators: {
          notEmpty: {
            message: "O valor é obrigatório e não pode estar vazio",
          },
        },
      },
      invoice_id: {
        validators: {
          notEmpty: {
            message: "O número da fatura é obrigatório e não pode estar vazio",
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
