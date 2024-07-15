$(document).ready(function () {
  $("#expensesform").bootstrapValidator({
    fields: {
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
      category_id: {
        validators: {
          notEmpty: {
            message: "A categoria é obrigatória e não pode estar vazia",
          },
        },
      },
      amount: {
        validators: {
          notEmpty: {
            message: "O valor não pode estar vazio",
          },
          regexp: {
            regexp: /^[0-9\.]+$/,
            message: "O valor deve consistir apenas de números e ponto",
          },
        },
      },
    },
  });
});
