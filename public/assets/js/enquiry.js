$(document).ready(function () {
  $("#enquiriesform").bootstrapValidator({
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
      address: {
        validators: {
          notEmpty: {
            message: "O endereço é obrigatório e não pode estar vazio",
          },
          stringLength: {
            max: 200,
            message: "Deve ter menos de 200 caracteres",
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
          stringLength: {
            max: 50,
            message: "Deve ter menos de 50 caracteres",
          },
        },
      },
      gender: {
        validators: {
          notEmpty: {
            message: "O gênero é obrigatório e não pode estar vazio",
          },
        },
      },
      pin_code: {
        validators: {
          notEmpty: {
            message: "O código postal é obrigatório e não pode estar vazio",
          },
          regexp: {
            regexp: /^[0-9_\.]+$/,
            message: "A entrada não é um código postal válido",
          },
        },
      },
      occupation: {
        validators: {
          notEmpty: {
            message: "A ocupação é obrigatória e não pode estar vazia",
          },
          stringLength: {
            max: 50,
            message: "Deve ter menos de 50 caracteres",
          },
        },
      },
      aim: {
        validators: {
          notEmpty: {
            message: "O objetivo é obrigatório e não pode estar vazio",
          },
          stringLength: {
            max: 50,
            message: "Deve ter menos de 50 caracteres",
          },
        },
      },
      source: {
        validators: {
          notEmpty: {
            message: "A fonte é obrigatória e não pode estar vazia",
          },
          stringLength: {
            max: 50,
            message: "Deve ter menos de 50 caracteres",
          },
        },
      },
      date: {
        validators: {
          notEmpty: {
            message: "A data é obrigatória e não pode estar vazia",
          },
        },
      },
      due_date: {
        validators: {
          notEmpty: {
            message:
              "A data de vencimento é obrigatória e não pode estar vazia",
          },
        },
      },
      followup_by: {
        validators: {
          notEmpty: {
            message: "O campo é obrigatório e não pode estar vazio",
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
      outcome: {
        validators: {
          notEmpty: {
            message: "O resultado é obrigatório e não pode estar vazio",
          },
        },
      },
      interested_in: {
        validators: {
          notEmpty: {
            message: "O campo é obrigatório e não pode estar vazio",
          },
          stringLength: {
            max: 50,
            message: "Deve ter menos de 50 caracteres",
          },
        },
      },
      contact: {
        validators: {
          notEmpty: {
            message: "O contato é obrigatório e não pode estar vazio",
          },
          regexp: {
            regexp: /^[0-9_\.]+$/,
            message: "A entrada não é um número válido",
          },
          stringLength: {
            max: 15,
            message: "Deve ter menos de 15 caracteres",
          },
        },
      },
    },
  });
});
