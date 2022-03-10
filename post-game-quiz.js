const question = document.getElementById("question");

const choices = Array.from(document.getElementsByClassName("choice-text"));

const progressText = document.getElementById('progressText');

const scoreText = document.getElementById('score');

const progressBarFull = document.getElementById('progressBarFull');



let currentQuestion = {};

let acceptingAnswers = false;

let score = 0;

let questionCounter = 0;

let availableQuestions = [];
var questions = [];
const request = new XMLHttpRequest();
request.open("POST", "post-game-questions.php",true); 
request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
request.send("questionrequest=post-game");
request.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);
        for(let i=10;i<20;i=i+1){
            questions.push({
                "question": data[i].question,

                "choice1": data[i].choice1,

                "choice2": data[i].choice2,

                "choice3":data[i].choice3,

                "choice4": data[i].choice4,

                "answer": data[i].answer,
            });
        }       
        // CONSTANTS
        const CORRECT_BONUS = 1;
        const MAX_QUESTIONS = 10;
        startGame = () => {
            questionCounter = -1;
            score = 0;
            availableQuestions = [...questions]
            getNewQuestion();
        };

        var storeScore = function(score){
            document.getElementById("postGameScore").value= score;
            document.getElementById("scoreSubmitForm").submit();
            /*const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "end-post-game.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("postGameScore="+score);*/

        }

        getNewQuestion = () => {
            if(availableQuestions.length === 0 || questionCounter >= MAX_QUESTIONS) {
                localStorage.setItem('mostRecentScore', score);
                storeScore(score);
                /* go to the end page
                return window.location.assign('end-post-game.php');*/
            }
            questionCounter++;
            progressText.innerText = `Question ${questionCounter}/${MAX_QUESTIONS}`;
            // update the progress bar
            progressBarFull.style.width = `${(questionCounter / MAX_QUESTIONS) * 100}%`;
            const questionIndex = Math.floor(Math.random() * availableQuestions.length);
            currentQuestion = availableQuestions[questionIndex];
            question.innerText = currentQuestion.question;
            choices.forEach( choice => {
                const number = choice.dataset['number'];
                choice.innerText = currentQuestion['choice' + number];
            });
            availableQuestions.splice(questionIndex, 1);
            acceptingAnswers = true;
        };
        choices.forEach( choice => {
            choice.addEventListener('click', e => {
                if(!acceptingAnswers) return;
                acceptingAnswers = false;
                const selectedChoice = e.target;
                const selectedAnswer = selectedChoice.dataset["number"];
                const classToApply = selectedAnswer == currentQuestion.answer ? 'correct' : 'incorrect';
                if(classToApply === 'correct') {
                    incrementScore(CORRECT_BONUS);
                }
                selectedChoice.parentElement.classList.add(classToApply);
                setTimeout( () => {
                    selectedChoice.parentElement.classList.remove(classToApply);
                    getNewQuestion();
                }, 1000);
            });
        });
        incrementScore = num => {
            score += num;
            scoreText.innerText = score;
        }
        startGame();
    }
}
