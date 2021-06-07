<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="score">Score: <span></span></div>
        <div class="correct">Correct</div>
        <div class="over" id="loss">
            GAME OVER! <br>
            YOUR SCORE IS <span></span>.
        </div>
        <div class="over" id="win">
            YOU WIN!<br>
            YOUR SCORE IS <span></span>
        </div>
        <div class="question">
            
        </div>
        <div class="low">
            <div class="info">Click on the correct answer </div>
            <div class="answer">
                <div class="answer-item" id="answer_1"></div>
                <div class="answer-item" id="answer_2"></div>
                <div class="answer-item" id="answer_3"></div>
                <div class="answer-item" id="answer_4"></div>
            </div>
        </div>
        
        <button class="submit" id="sub">
            Start Game
        </button>
        <div class="time">Time remaining: <span id = "s"></span> sec</div>
    </div>
    
</body>
<script>
    var s;
    var timer = setInterval( calltimer, 1000);
    var score = 0;
    var win = 1000;
     $(document).ready(function(){
        
        var check = true;
        $(".score span").append(score);
        $(".time").hide();
        $(".correct").hide();
        $("#loss").hide();
        $("#win").hide();
        var start = true;
        
        $("#sub").click(function(){
            if(start){
                $(this).text("Reset Game");
                start = false;
                $.ajax({
                    method: "GET",
                    url: "./game.php",
                })
                .done(function(response) {
                    var res=JSON.parse(response);
                    console.log(res);
                    showQuestion(res);
                    s = res["time"];
                    win = res["win"];
                })
                .fail(function(){
                    // alert( "error" );
                });
                
                calltimer();
                $(".time").show();

            }
            else{
                $(this).text("Start Game");
                $(".time").hide();
                start = true;
                location.reload();
            }
        });
        $(".answer-item").click(function(event){
            var choose = $(this).text();
            var a = $(".a").text();
            var b = $(".b").text();
            var o = $(".operator").text();
            $.ajax({
                    method: "POST",
                    url: "./game.php",
                    data: {"a": a, "b": b, "o":o, "choose":choose }
                    
                })
                .done(function(response) {
                    var res=JSON.parse(response);
                    console.log(res);
                    check = res["check"];
                    if(check){
                        deleteQuestion();
                        score +=1;
                        if(score == win){
                            $("#win span").append(score);
                            $("#win").show();
                            clearInterval(timer);
                        } 
                        $(".score span").empty();
                        $(".score span").append(score);
                        showQuestion(res);
                    }
                    else{
                        $("#loss span").append(score);
                        $("#loss").show();
                        clearInterval(timer);
                    }
                })
                .fail(function(){
                    alert( "error" );
                });
            
        });
    });
    
    function showQuestion(res){
        $(".question").append(res["a"] + res["o"] + res["b"]);
        $('#answer_1').append(res["kq"][0]);
        $('#answer_2').append(res["kq"][1]);
        $('#answer_3').append(res["kq"][2]);
        $('#answer_4').append(res["kq"][3]);
    }

    function deleteQuestion(){
        $(".question").empty();
        $('#answer_1').empty();
        $('#answer_2').empty();
        $('#answer_3').empty();
        $('#answer_4').empty();
    }
    
    function calltimer(){
        console.log(s);
        $("#s").empty();
        $("#s").append(s);
        if(s==0 ){
            clearInterval(timer);
            $("#loss span").append(score);
            $("#loss").show();
            // alert("hết giờ");
        }
        s--;
        
    }
    
</script>
</html>