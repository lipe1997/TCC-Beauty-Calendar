$(function () {
    $("#prox").on("click", function () {
        var resp = verProf();
        if (resp > 0) {
            $(".progress").css({
                background: "linear-gradient(to right,#fdc303 50%,rgba(0,0,0,0.8) 50%)"
            });
            $("#segunda").css({
                background: "#fdc303",
                color:"white",
            })
            $(".form1").css({
                display:"none"
            })
            $(".form2").css({
                display:"block"
            })
        }
        else {
            alert("Cadastre um profissional para prosseguir");
        }
        
    })
    $("#anterior").on("click", function () {
        $(".progress").css({
            background: "black"
        });
        $("#segunda").css({
            background: "black",
            color:"white",
        })
        $(".form1").css({
            display:"block"
        })
        $(".form2").css({
            display:"none"
        })
    })
    $("#prox1").on("click", function () {
        $(".progress").css({
            background: "linear-gradient(to right,#fdc303 100%,#000000 0%)"
        });
        $("#terceira").css({
            background: "#fdc303",
            color:"white",
        })
        $(".form3").css({
            display:"block"
        })
        $(".form2").css({
            display:"none"
        })
    })
    $("#anterior1").on("click", function () {
        $(".progress").css({
            background: "linear-gradient(to right,#fdc303 50%,rgba(0,0,0,0.8) 50%)"
        });
        $("#terceira").css({
            background: "black",
            color:"white",
        })
        $(".form2").css({
            display:"block"
        })
        $(".form3").css({
            display:"none"
        })
    })
    
    function verProf() {
        $.ajax({
            url: 'verProf.php',
            success: function (resp) {
                return resp;
            }
        })
    }
});