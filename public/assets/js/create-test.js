// $(document).ready(function() {
//     let previousValue = $(".editor").val(); // Store the initial value

//     $(".editor").on("input", function() {
//         let currentValue = $(this).val();

//         if (currentValue !== previousValue) {
//             console.log("Textarea value changed");
//             previousValue = currentValue; // Update previous value
//             console.log(currentValue);
//             if (currentValue.includes('\n')) {
//                 console.log('next line');
//             }
//         }
//     });
// });

// $('.create-test-btn').click((e) => {
//     e.preventDefault();
//     $('#create-test-form').submit();
// });

// Elements
const editorCode = document.getElementById("editorCode");
// const editorPreview = document.getElementById('editorPreview').contentWindow.document;
const editorCopyButton = document.getElementById('editorCopyClipboard');

// Monaco loader
require.config({
    paths: {
        vs: "https://cdn.jsdelivr.net/npm/monaco-editor/min/vs"
    }
});

window.MonacoEnvironment = {
    getWorkerUrl: function (workerId, label) {
        return `data:text/javascript;charset=utf-8,${encodeURIComponent(`
    self.MonacoEnvironment = {
      baseUrl: 'https://cdn.jsdelivr.net/npm/monaco-editor/min/'
    };
    importScripts('https://cdn.jsdelivr.net/npm/monaco-editor/min/vs/base/worker/workerMain.js');`)}`;
    }
};

// Monaco init
require(["vs/editor/editor.main"], function () {
    createEditor(editorCode);
});


var button_index = 0;
var isLast = true;

function createEditor(editorContainer) {
    let editor = monaco.editor.create(editorContainer, {
        language: "html",
        minimap: {
            enabled: false
        },
        automaticLayout: true,
        contextmenu: false,
        fontSize: 14,
        scrollbar: {
            useShadows: false,
            vertical: "visible",
            horizontal: "visible",
            horizontalScrollbarSize: 12,
            verticalScrollbarSize: 12
        },
        suggest: {
            showWords: false,
            showFunctions: false,
            showKeywords: false,
            showSnippets: false,
        },
        quickSuggestions: false,
        autoClosingBrackets: "never",
        autoClosingQuotes: "never"
    });



    $(document).ready(function () {

        editor.onDidChangeModelContent(() => {
            const input = editor.getValue();
            const lines = input.split("\n"); // Tách từng dòng
            let questions_arr = [];
            window.questions_arr = questions_arr;
            let currentQuestion = null;

            lines.forEach((line, index) => {
                line = line.trim();

                // Kiểm tra xem có phải là câu hỏi mới (bắt đầu bằng dấu ')
                if (line.startsWith("'")) {
                    // Nếu có câu hỏi hiện tại, lưu nó vào mảng trước khi tạo câu hỏi mới
                    if (currentQuestion) {
                        questions_arr.push(currentQuestion);
                    }

                    // Khởi tạo câu hỏi mới
                    currentQuestion = {
                        lineNumber: index + 1,
                        question_content: line.substring(1).trim(), // Nội dung câu hỏi
                        question_options: [], // Mảng các lựa chọn
                        answer: null // Câu trả lời đúng
                    };
                } else if (currentQuestion && line !== "") {
                    // Xử lý các lựa chọn đáp án
                    const isCorrect = line.startsWith("*");
                    const optionText = isCorrect ? line.substring(1).trim() : line;

                    currentQuestion.question_options.push(optionText);
                    if (isCorrect) {
                        currentQuestion.answer = optionText;
                    }
                }

                // Nếu là dòng cuối và vẫn còn câu hỏi đang xử lý, lưu câu hỏi đó
                if (index === lines.length - 1 && currentQuestion) {
                    questions_arr.push(currentQuestion);
                    if (isLast)
                        button_index = questions_arr.length - 1;
                }
            });

            displayQuestions(questions_arr);
            try {
                showQuestionDetail(questions_arr[button_index]);
            } catch(err) {
                return;
            }
            console.log(questions_arr);
        });
    });

    function displayQuestions(questions_arr) {
        const previewDiv = document.getElementById("preview");
        previewDiv.innerHTML = ""; // Xóa nội dung cũ

        // Tạo nút cho từng câu hỏi
        questions_arr.forEach((question, index) => {
            const button = document.createElement("button");
            button.textContent = `Câu ${index + 1}`;
            button.style.margin = "5px";
            button.onclick = function () {
                if (index != questions_arr.length - 1) 
                    isLast = false;
                else 
                    isLast = true;
                button_index = index;
                showQuestionDetail(question); // Hiển thị chi tiết câu hỏi khi bấm nút
                editor.setPosition({ lineNumber: question.lineNumber, column: 1 })
                editor.setScrollPosition({ scrollTop: question.lineNumber });
                editor.focus();
            };
            previewDiv.appendChild(button);
        });

        if (button_index === questions_arr.length - 1) {
            showQuestionDetail(questions_arr[button_index]);
        }
    }

    function showQuestionDetail(question) {
        const questionDetailDiv = document.createElement("div");
        questionDetailDiv.innerHTML = `<strong>Cau ${button_index + 1}: ${question.question_content}</strong><br>`;
        
        // Xóa các chi tiết cũ
        const contentPreview = document.getElementById("content-preview");
        contentPreview.innerHTML = "";
        
        
        // Thêm lại các nút câu hỏi
        // displayQuestions(questions_arr);

        // Thêm chi tiết câu hỏi
        question.question_options.forEach((option, i) => {
            const optionDiv = document.createElement("div");
            optionDiv.textContent = `${String.fromCharCode(65 + i)}. ${option}`;
            if (option === question.answer) {
                optionDiv.style.color = "green";
                optionDiv.innerHTML += " (Đáp án đúng)";
            }
            questionDetailDiv.appendChild(optionDiv);
        });

        contentPreview.appendChild(questionDetailDiv);
    }


}
