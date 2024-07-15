$(document).ready(function () {
  $("#loginform").bootstrapValidator({
    fields: {
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
      password: {
        validators: {
          notEmpty: {
            message: "A senha é obrigatória e não pode estar vazia",
          },
        },
      },
    },
  });
});
