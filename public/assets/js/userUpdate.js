$(document).ready(function () {
  $("#usersform").bootstrapValidator({
    fields: {
      name: {
        validators: {
          notEmpty: {
            message: "O nome é obrigatório e não pode estar vazio",
          },
        },
      },
      email: {
        validators: {
          notEmpty: {
            message: "O endereço de email é obrigatório e não pode estar vazio",
          },
          emailAddress: {
            message: "A entrada não é um endereço de email válido",
          },
        },
      },
    },
  });
});
