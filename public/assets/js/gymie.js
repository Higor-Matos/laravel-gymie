var gymie = (function ($) {
  "use strict";
  return {
    /* --------------------------------- */
    /* TokenInput
		/* --------------------------------- */
    loadBsTokenInput: function () {
      $(".tokenfield").tokenfield();
    },

    /* --------------------------------- */
    /* Custom send message
		/* --------------------------------- */
    customsendmessage: function () {
      $("#customcontactsdiv").hide();
      $("#custom").on("change", function () {
        if (this.checked) {
          $("#customcontactsdiv").show();
        } else {
          $("#customcontactsdiv").hide();
        }
      });
    },

    /* --------------------------------- */
    /* Cheque Details
		/* --------------------------------- */
    chequedetails: function () {
      $("#chequeDetails").hide();

      $("#mode").on("change", function () {
        if (this.value == "0") {
          $("#chequeDetails").show();
        } else {
          $("#chequeDetails").hide();
        }
      });
    },

    /* --------------------------------- */
    /* Progress Animation
		/* --------------------------------- */
    loadprogress: function () {
      setTimeout(function () {
        $(".progress-animation .progress-bar").each(function () {
          var me = $(this);
          var perc = me.attr("aria-valuenow");
          var current_perc = 0;
          var progress = setInterval(function () {
            if (current_perc >= perc) {
              clearInterval(progress);
            } else {
              current_perc += 1;
              me.css("width", current_perc + "%");
            }
          }, 0);
        });
      }, 0);
    },

    /* --------------------------------- */
    /* Bootstrap Select
		/* --------------------------------- */
    loadbsselect: function () {
      $("select").removeClass("show-menu-arrow");
      $(".selectpicker,select").selectpicker({
        noneSelectedText: "Nada selecionado",
        noneResultsText: "Nenhum resultado encontrado {0}",
        countSelectedText: "{0} selecionados",
        maxOptionsText: [
          "Limite atingido ({n} {var} max)",
          "Limite do grupo atingido ({n} {var} max)",
          ["itens", "item"],
        ],
        selectAllText: "Selecionar todos",
        deselectAllText: "Desmarcar todos",
        multipleSeparator: ", ",
      });
    },

    /* --------------------------------- */
    /* Date Picker  : http://eternicode.github.io/bootstrap-datepicker
		/* --------------------------------- */
    loaddatepicker: function () {
      // Default
      $(".datepicker-default").datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true,
        language: "pt-BR",
      });
    },

    loaddatepickerstart: function () {
      $(".datepicker-startdate").datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true,
        language: "pt-BR",
      });
    },

    loaddatepickerend: function () {
      var subscription_days = $(".plan-data").data("days");
      var subscription_end_date = $("#end_date").val();
      var endDatelimit = moment(subscription_end_date, "DD/MM/YYYY")
        .add(subscription_days, "days")
        .format("DD/MM/YYYY");

      $(".datepicker-enddate").datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true,
        startDate: gymieEndDate,
        endDate: gymieDiff,
        language: "pt-BR",
      });
    },

    /* --------------------------------- */
    /* Charts
		/* --------------------------------- */
    loadmorris: function () {
      // LINE CHART
      var line = new Morris.Line({
        element: "gymie-registrations-trend",
        resize: true,
        data: JSON.parse(jsRegistraionsCount),
        xkey: "month",
        ykeys: ["registrations"],
        labels: ["Alunos"],
        hideHover: "auto",
        lineColors: ["#27ae60"],
      });

      //DONUT CHART
      var donut = new Morris.Donut({
        element: "gymie-members-per-plan",
        resize: true,
        colors: ["#e74c3c", "#e67e22", "#3498db"],
        data: JSON.parse(jsMembersPerPlan),
        hideHover: "auto",
      });
    },

    /* --------------------------------- */
    /* iCheck
		/* --------------------------------- */
    loadicheck: function () {
      $(".skin-square input").iCheck({
        checkboxClass: "icheckbox_square-green",
        radioClass: "iradio_square-green",
        increaseArea: "20%",
      });
    },

    /* --------------------------------- */
    /* Bootstrap File Input
		/* --------------------------------- */
    loadfileinput: function () {
      $(".file-inputs").bootstrapFileInput();
    },

    /* --------------------------------- */
    /* Datepicker
		/* --------------------------------- */
    loaddaterangepicker: function () {
      function cb(start, end) {
        $(".gymie-daterangepicker span").html(
          moment(start).format("DD/MM/YYYY") +
            " - " +
            moment(end).format("DD/MM/YYYY")
        );
        $("#drp_start").val(moment(start).format("DD/MM/YYYY"));
        $("#drp_end").val(moment(end).format("DD/MM/YYYY"));
      }

      $(".gymie-daterangepicker").daterangepicker(
        {
          locale: {
            format: "DD/MM/YYYY",
            separator: " - ",
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            fromLabel: "De",
            toLabel: "Até",
            customRangeLabel: "Personalizado",
            daysOfWeek: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
            monthNames: [
              "Janeiro",
              "Fevereiro",
              "Março",
              "Abril",
              "Maio",
              "Junho",
              "Julho",
              "Agosto",
              "Setembro",
              "Outubro",
              "Novembro",
              "Dezembro",
            ],
            firstDay: 1,
          },
          ranges: {
            Hoje: [moment(), moment()],
            Ontem: [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Últimos 7 Dias": [moment().subtract(6, "days"), moment()],
            "Últimos 30 Dias": [moment().subtract(29, "days"), moment()],
            "Este Mês": [moment().startOf("month"), moment().endOf("month")],
            "Mês Passado": [
              moment().subtract(1, "month").startOf("month"),
              moment().subtract(1, "month").endOf("month"),
            ],
            "Intervalo Personalizado": [],
          },
        },
        cb
      );
    },

    /* --------------------------------- */
    /* counter
		/* --------------------------------- */
    loadcounter: function () {
      $("[data-toggle='counter']").countTo();
    },

    /* --------------------------------- */
    /* Enquiries 'Mark as' sweetalert
		/* --------------------------------- */
    markEnquiryAs: function () {
      $(".mark-enquiry-as").click(function () {
        var recordId = $(this).attr("data-record-id");
        var gotoUrl = $(this).attr("data-goto-url");

        markAs(recordId, gotoUrl);
      });

      function markAs(recordId, gotoUrl) {
        swal(
          {
            title: "Tem certeza?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            confirmButtonText: "Sim!",
            confirmButtonColor: "#ec6c62",
          },
          function () {
            $.ajax({
              url: gotoUrl,
              type: "POST",
            })
              .done(function (data) {
                swal(
                  {
                    title: "Feito",
                    type: "success",
                  },
                  function () {
                    location.reload();
                  }
                );
              })
              .error(function (data) {
                swal("Oops", "Não foi possível conectar ao servidor!", "error");
              });
          }
        );
      }
    },

    /* --------------------------------- */
    /* Member delete sweetalert
		/* --------------------------------- */
    deleterecord: function () {
      $(".delete-record").click(function () {
        var recordId = $(this).attr("data-record-id");
        var deleteUrl = $(this).attr("data-delete-url");

        if ($(this).attr("data-dependency") === "true") {
          var dependency = $(this).attr("data-dependency");
          var dependencyMessage = $(this).attr("data-dependency-message");
        } else {
          var dependency = false;
          var dependencyMessage = "Dependência de dados";
        }

        recordDelete(recordId, deleteUrl, dependency, dependencyMessage);
      });

      function recordDelete(
        recordId,
        deleteUrl,
        dependency,
        dependencyMessage
      ) {
        if (dependency) {
          swal("Aviso!", dependencyMessage, "warning");
        } else {
          swal(
            {
              title: "Tem certeza?",
              text: "Excluir isso também excluirá todos os registros relacionados, você ainda deseja excluir este registro?",
              type: "warning",
              showCancelButton: true,
              showLoaderOnConfirm: true,
              closeOnConfirm: false,
              confirmButtonText: "Sim, excluir!",
              confirmButtonColor: "#ec6c62",
            },
            function () {
              $.ajax({
                url: deleteUrl,
                type: "POST",
              })
                .done(function (data) {
                  swal(
                    {
                      title: "Excluído",
                      text: "Registro excluído com sucesso",
                      type: "success",
                    },
                    function () {
                      location.reload();
                    }
                  );
                })
                .error(function (data) {
                  swal(
                    "Oops",
                    "Não foi possível conectar ao servidor!",
                    "error"
                  );
                });
            }
          );
        }
      }
    },

    applyDiscount: function () {
      function getDiscountAmount() {
        var subscription_amount = parseInt($("#subscription_amount").val());
        var additional_fees = $("#additional_fees").length
          ? parseInt($("#additional_fees").val())
          : 0;
        var total_amount = subscription_amount + additional_fees;
        var tax = Math.round((total_amount * taxes) / 100);
        var total = total_amount + tax;

        var discount_value = parseInt($("#discount_percent").val());
        var discount_amount = isNaN(discount_value)
          ? $("#discount_amount").val()
          : Math.round((total * discount_value) / 100);
        $("#discount_amount").val(discount_amount);

        var payment_amount = total - discount_amount;
        $("#payment_amount").val(Math.round(payment_amount));
      }

      function getCustomDiscountAmount() {
        var subscription_amount = parseInt($("#subscription_amount").val());
        var additional_fees = $("#additional_fees").length
          ? parseInt($("#additional_fees").val())
          : 0;
        var total_amount = subscription_amount + additional_fees;
        var tax = Math.round((total_amount * taxes) / 100);
        var total = total_amount + tax;

        var discount_value = $("#discount_amount").val();
        var discount_amount = isNaN(discount_value) ? "" : discount_value;
        var payment_amount = total - discount_amount;
        $("#payment_amount").val(Math.round(payment_amount));
      }

      $("#discount_percent").bind("change keyup input", function (e) {
        getDiscountAmount();
        if ($("#discount_percent").val() != "custom") {
          $("#discount_amount").attr("readonly", true);
        } else {
          $("#discount_amount").attr("readonly", false);
        }
      });

      $("#discount_amount").bind("change keyup input", function () {
        if ($("#discount_percent").val() == "custom") {
          getCustomDiscountAmount();
        }
      });
    },

    subscription: function () {
      function getEndDate(rowId) {
        var plan_days =
          $(".plan-id select#plan_" + rowId + " option:selected").data("days") -
          1;
        var subscription_start_date = $(
          ".plan-start-date input#start_date_" + rowId
        ).val();
        var subscription_end_date = moment(
          subscription_start_date,
          "DD/MM/YYYY"
        )
          .add(plan_days, "days")
          .format("DD/MM/YYYY");

        $(".plan-end-date input#end_date_" + rowId).val(subscription_end_date);
      }

      function getPlanAmount() {
        var sum = 0;
        $(".plan-id select option:selected").each(function () {
          sum += +$(this).data("price");
          $(".plan-price input#price_" + $(this).data("row-id")).val(
            $(this).data("price")
          );
        });
        $("#subscription_amount").val(sum).trigger("change");
      }

      function getTaxAmount() {
        var subscription_amount = parseInt($("#subscription_amount").val());
        var additional_fees = $("#additional_fees").length
          ? parseInt($("#additional_fees").val())
          : 0;
        var total_amount = subscription_amount + additional_fees;
        var tax = Math.round((total_amount * taxes) / 100);
        $("#taxes_amount").val(tax);
      }

      function getDiscountAmount() {
        var subscription_amount = parseInt($("#subscription_amount").val());
        var additional_fees = $("#additional_fees").length
          ? parseInt($("#additional_fees").val())
          : 0;
        var total_amount = subscription_amount + additional_fees;
        var tax = Math.round((total_amount * taxes) / 100);
        var total = total_amount + tax;

        var discount_value = parseInt($("#discount_percent").val());
        var discount_amount = isNaN(discount_value)
          ? $("#discount_amount").val()
          : Math.round((total * discount_value) / 100);
        $("#discount_amount").val(discount_amount);

        var payment_amount = total - discount_amount;

        $("#payment_amount").val(Math.round(payment_amount));
        $("#payment_amount").data("amounttotal", $("#payment_amount").val());
      }

      function getCustomDiscountAmount() {
        var subscription_amount = parseInt($("#subscription_amount").val());
        var additional_fees = $("#additional_fees").length
          ? parseInt($("#additional_fees").val())
          : 0;
        var total_amount = subscription_amount + additional_fees;
        var tax = Math.round((total_amount * taxes) / 100);
        var total = total_amount + tax;

        var discount_value = $("#discount_amount").val();
        var discount_amount = isNaN(discount_value) ? "" : discount_value;
        var payment_amount = total - discount_amount;

        $("#payment_amount").val(Math.round(payment_amount));
        $("#payment_amount").data("amounttotal", $("#payment_amount").val());
      }

      $(document).ready(function () {
        getEndDate(0);
        getPlanAmount();
        $("#payment_amount_pending").val(0);
      });

      $(document).on("change", ".plan-id select", function () {
        getEndDate($(this).data("row-id"));
        getPlanAmount();
        $(this).selectpicker("refresh");
      });

      $(document).on(
        "change keyup input",
        ".plan-start-date input",
        function () {
          getEndDate($(this).data("row-id"));
        }
      );

      $("#subscription_amount").bind("change keyup input", function (e) {
        getTaxAmount();
        getDiscountAmount();
      });

      $("#additional_fees").bind("change keyup input", function () {
        getTaxAmount();
        getDiscountAmount();
      });

      $("#discount_percent").bind("change keyup input", function (e) {
        getDiscountAmount();
        if ($("#discount_percent").val() != "custom") {
          $("#discount_amount").attr("readonly", true);
        } else {
          $("#discount_amount").attr("readonly", false);
        }
      });

      $("#discount_amount").bind("change keyup input", function () {
        if ($("#discount_percent").val() == "custom") {
          getCustomDiscountAmount();
        }
      });

      $("#payment_amount").bind("change keyup input", function () {
        var payment_total = $("#payment_amount").data("amounttotal");
        if ($("#previous_payment").length) {
          var pending =
            payment_total -
            parseInt($("#previous_payment").val()) -
            parseInt($("#payment_amount").val());
        } else {
          var pending = payment_total - parseInt($("#payment_amount").val());
        }
        $("#payment_amount_pending").val(isNaN(pending) ? 0 : pending);
      });

      var x = typeof currentServices != "undefined" ? currentServices - 1 : 0;
      var max_fields = servicesCount - 1;
      if (x == max_fields) {
        $("#addSubscription").hide();
      }

      $("#addSubscription").click(function () {
        if (x < max_fields) {
          x++;

          $("#servicesContainer>.row:first-child")
            .clone()
            .appendTo("#servicesContainer");
          $("#servicesContainer>.row:last-child .remove-service").removeClass(
            "hide"
          );
          $("#servicesContainer>.row:last-child .bootstrap-select").remove();

          $(
            "#servicesContainer>.row:last-child .plan-start-date>small"
          ).remove();
          $(
            "#servicesContainer>.row:last-child .plan-start-date>input"
          ).removeAttr("data-bv-field");

          $("#servicesContainer>.row:last-child .plan-id>select")
            .attr("id", "plan_" + x)
            .attr("name", "plan[" + x + "][id]")
            .attr("data-row-id", x);
          $("#servicesContainer>.row:last-child .plan-id>select>option").attr(
            "data-row-id",
            x
          );
          $("#servicesContainer>.row:last-child .plan-start-date>input")
            .attr("id", "start_date_" + x)
            .attr("name", "plan[" + x + "][start_date]")
            .attr("data-row-id", x);
          $("#servicesContainer>.row:last-child .plan-end-date>input")
            .attr("id", "end_date_" + x)
            .attr("name", "plan[" + x + "][end_date]")
            .attr("data-row-id", x);
          $("#servicesContainer>.row:last-child .plan-price>input")
            .attr("id", "price_" + x)
            .attr("name", "plan[" + x + "][price]")
            .attr("data-row-id", x);

          gymie.loadbsselect();
          gymie.loaddatepickerstart();

          getPlanAmount();

          if (x == max_fields) {
            $("#addSubscription").hide();
          }
        }
      });

      $("#servicesContainer").on("click", "span.remove-service", function () {
        $(this).closest(".row").remove();
        x--;
        getPlanAmount();
        if (x < max_fields) {
          $("#addSubscription").show();
        }
      });
    },

    subscriptionChange: function () {
      function getAmountToPay() {
        var totalAmount = parseInt($("#payment_amount").val());
        var alreadyPaid = parseInt($("#previous_payment").val());
        var newTotal = totalAmount - alreadyPaid;
        $("#payment_amount").val(newTotal);
      }

      $(document).ready(function () {
        getAmountToPay();
      });

      $(document).on("change", ".plan-id select", function () {
        getAmountToPay();
      });

      $("#discount_amount").bind("change keyup input", function () {
        getAmountToPay();
      });
    },
  };
})(jQuery);

$(document).ready(function () {
  gymie.loadcounter();
  gymie.loadprogress();
  gymie.loaddatepicker();
  gymie.loaddaterangepicker();
  gymie.loadbsselect();
});
