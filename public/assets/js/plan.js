$(document).ready(function () {
  $("#plansform").bootstrapValidator({
    fields: {
      plan_code: {
        validators: {
          notEmpty: {
            message: "O código é obrigatório e não pode estar vazio",
          },
          stringLength: {
            max: 50,
            message: "Deve ter menos de 50 caracteres",
          },
        },
      },
      plan_name: {
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
      status: {
        validators: {
          notEmpty: {
            message: "O status é obrigatório e não pode estar vazio",
          },
        },
      },
      plan_details: {
        validators: {
          notEmpty: {
            message: "Os detalhes são obrigatórios e não podem estar vazios",
          },
          stringLength: {
            max: 50,
            message: "Deve ter menos de 50 caracteres",
          },
        },
      },
      days: {
        validators: {
          notEmpty: {
            message: "O número de dias é obrigatório e não pode estar vazio",
          },
          regexp: {
            regexp: /^[0-9]+$/,
            message: "Insira um número válido de dias",
          },
        },
      },
      amount: {
        validators: {
          notEmpty: {
            message: "O valor é obrigatório e não pode estar vazio",
          },
          regexp: {
            regexp: /^[0-9\.]+$/,
            message: "Insira um valor válido",
          },
        },
      },
    },
  });
});
