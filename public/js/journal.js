const debitButton = $("#debitButton");
const creditButton = $("#creditButton");
var creditTotal = 0;
var debitTotal = 0;

function addCredit() {
    const creditTable = document.getElementById("creditTable");
    const creditName = $("#txtCreditCode option:selected").text().split(":")[1];
    const creditAmount = $("#txtCreditAmount").val();
    const creditCode = $("#txtCreditCode").val();
    $("#creditTable")
        .find("tbody")
        .append(
            "<tr tabType ='credit' amount ='" +
            creditAmount +
            "'><td >" +
            creditCode +
            "</td><td>" +
            creditName +
            "</td><td>" +
            creditAmount +
            '<input type="hidden" name="creditItems[]" value ="' +
            creditCode +
            "*" +
            creditAmount +
            "*" +
            creditName +
            '"></td><td><button id="removeBtn" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash">Remove</span></button></td </tr>'
        );
    creditTotal = creditTotal + parseInt(creditAmount);
    $("#creditTable caption").text("Total CR Amount : " + creditTotal);
    $("#txtCreditName").val("");
    $("#txtCreditAmount").val("");
    $("#txtCreditCode").val("");
}

function addDebit() {
    const table = document.getElementById("debitTable");
    const name = $("#txtDebitCode option:selected").text().split(":")[1];
    const amount = $("#txtDebitAmount").val();
    const code = $("#txtDebitCode").val();
    $("#debitTable")
        .find("tbody")
        .append(
            "<tr tabType ='debit' amount ='" +
            amount +
            "'><td >" +
            code +
            "</td><td>" +
            name +
            "</td><td>" +
            amount +
            '<input type="hidden" name="debitItems[]" value ="' +
            code +
            "*" +
            amount +
            "*" +
            name +
            '"></td><td><button id="removeBtn" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash">Remove</span></button></td </tr>'
        );
    debitTotal = debitTotal + parseFloat(amount);
    $("#debitTable caption").text("Total DR Amount : " + debitTotal);
    $("#txtDebitName").val("");
    $("#txtDebitAmount").val(0);
    $("#txtDebitCode").val("");
}
$(document).on("click", "#removeBtn", function(e) {
    var a = this;
    let row = $(this)
        .parent()
        .parent();
    console.log(row.attr("tabtype"));
    console.log(row.attr("amount"));
    if (row.attr("tabtype") == "debit") {
        debitTotal = debitTotal - parseFloat(row.attr("amount"));
        $("#debitTable caption").text("Total DR Amount : " + debitTotal);
    } else {
        creditTotal = creditTotal - parseFloat(row.attr("amount"));
        $("#creditTable caption").text("Total DR Amount : " + creditTotal);
    }
    row.remove();

    /*$.ajax({
      type: "get",
      url: "/removeItem",
      data: { id: this.id },
      dataType: "json",
      success: function(response) {
        $(a)
          .parent()
          .parent()
          .remove();
        console.log(response);
        total = total - response;
        $("#tot").text(total);
      }
    });*/
});
$(document).on("click", "#save", function(e) {
    if (creditTotal == debitTotal && creditTotal > 0) {
        $("#myForm").submit();
    } else {
        alert("SJV entries Not balanced");
    }
});

$(document).ready(function() {
    $(".select2").select2();
});

$("#txtDebitCode").on("change", function() {
    let code = $(this).val();
    $.ajax({
        type: "GET",
        url: "/getDesc",
        data: { code: code },
        success: function(response) {
            $("#txtDebitName").val(response);
        },
        erro: function(response) {
            console.log({ response });
        }
    });
});
$("#txtCreditCode").on("change", function() {
    console.lo;
    let code = $(this).val();
    $.ajax({
        type: "GET",
        url: "/getDesc",
        data: { code: code },
        success: function(response) {
            $("#txtCreditName").val(response);
        },
        erro: function(response) {
            console.log({ response });
        }
    });
});

$("#submit").on("click", function(event) {
    console.log("here");
});