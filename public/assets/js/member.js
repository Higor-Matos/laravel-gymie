var startDateValidators = {
  row: ".plan-start-date",
  validators: {
    notEmpty: {
      message: "A data de início é obrigatória",
    },
  },
};

$("#membersform").bootstrapValidator({
  fields: {
    member_code: {
      validators: {
        notEmpty: {
          message: "O código do Aluno é obrigatório e não pode estar vazio",
        },
      },
    },
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
    DOB: {
      validators: {
        notEmpty: {
          message: "A data de nascimento é obrigatória",
        },
        date: {
          format: "YYYY-MM-DD",
          message: "A data deve estar no formato YYYY-MM-DD",
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
    health_issues: {
      validators: {
        notEmpty: {
          message: "Este campo é obrigatório e não pode estar vazio",
        },
      },
    },
    proof_name: {
      validators: {
        notEmpty: {
          message:
            "O Forma de pagamento preferencial é obrigatório e não pode estar vazio",
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
    plan_id: {
      validators: {
        notEmpty: {
          message: "O ID do plano é obrigatório e não pode estar vazio",
        },
      },
    },
    pin_code: {
      validators: {
        notEmpty: {
          message: "O código PIN é obrigatório e não pode estar vazio",
        },
        regexp: {
          regexp: /^[0-9\.]+$/,
          message: "A entrada não é um código PIN válido",
        },
      },
    },
    occupation: {
      validators: {
        notEmpty: {
          message: "A ocupação é obrigatória e não pode estar vazio",
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
          message: "A fonte é obrigatória e não pode estar vazio",
        },
        stringLength: {
          max: 50,
          message: "Deve ter menos de 50 caracteres",
        },
      },
    },
    invoice_number: {
      validators: {
        notEmpty: {
          message: "O número da fatura é obrigatório e não pode estar vazio",
        },
      },
    },
      admission_amount: {
        validators: {
          notEmpty: {
            message: "O valor de admissão é obrigatório e não pode estar vazio",
          },
          regexp: {
            regexp: /^(NaN|[0-9\.]+)$/,
            message: "A entrada não é um valor válido",
          },
        },
      },
    },
    subscription_amount: {
      validators: {
        notEmpty: {
          message: "O valor da assinatura é obrigatório e não pode estar vazio",
        },
        regexp: {
          regexp: /^[0-9\.]+$/,
          message: "A entrada não é um valor válido",
        },
      },
    },
    taxes_amount: {
      validators: {
        notEmpty: {
          message: "O valor dos impostos é obrigatório e não pode estar vazio",
        },
        regexp: {
          regexp: /^[0-9\.]+$/,
          message: "A entrada não é um valor válido",
        },
      },
    },
    payment_amount: {
      validators: {
        notEmpty: {
          message: "O valor é obrigatório e não pode estar vazio",
        },
        regexp: {
          regexp: /^[0-9\.]+$/,
          message: "A entrada não é um valor válido",
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
    contact: {
      validators: {
        notEmpty: {
          message: "O contato é obrigatório e não pode estar vazio",
        },
        regexp: {
          regexp: /^[0-9\.]+$/,
          message: "A entrada não é um número válido",
        },
        stringLength: {
          max: 15,
          message: "Deve ter menos de 15 caracteres",
        },
      },
    },
    emergency_contact: {
      validators: {
        notEmpty: {
          message: "O contato é obrigatório e não pode estar vazio",
        },
        regexp: {
          regexp: /^[0-9\.]+$/,
          message: "A entrada não é um número válido",
        },
        stringLength: {
          max: 15,
          message: "Deve ter menos de 15 caracteres",
        },
      },
    },
    "plan[0].start_date": startDateValidators,
  },
});
