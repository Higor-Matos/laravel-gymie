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
      password: {
        validators: {
          notEmpty: {
            message: "A senha é obrigatória e não pode estar vazia",
          },
          stringLength: {
            min: 6,
            message: "A senha deve ter pelo menos 6 caracteres",
          },
          identical: {
            field: "password_confirmation",
            message: "A senha e sua confirmação não são iguais",
          },
        },
      },
      password_confirmation: {
        validators: {
          notEmpty: {
            message:
              "A confirmação da senha é obrigatória e não pode estar vazia",
          },
          identical: {
            field: "password",
            message: "A senha e sua confirmação não são iguais",
          },
        },
      },
    },
  });
});
