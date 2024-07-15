$(document).ready(function () {
  $("#expensecategoriesform").bootstrapValidator({
    fields: {
      name: {
        validators: {
          notEmpty: {
            message: "O nome da categoria é obrigatório e não pode estar vazio",
          },
          stringLength: {
            max: 50,
            message: "Deve ter menos de 50 caracteres",
          },
        },
      },
    },
  });
});
