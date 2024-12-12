// // $(document).ready(function() {
// //     let previousValue = $(".editor").val(); // Store the initial value

// //     $(".editor").on("input", function() {
// //         let currentValue = $(this).val();

// //         if (currentValue !== previousValue) {
// //             console.log("Textarea value changed");
// //             previousValue = currentValue; // Update previous value
// //             console.log(currentValue);
// //             if (currentValue.includes('\n')) {
// //                 console.log('next line');
// //             }
// //         }
// //     });
// // });

// // $('.create-test-btn').click((e) => {
// //     e.preventDefault();
// //     $('#create-test-form').submit();
// // });

// // Elements
// const editorCode = document.getElementById("editorCode");
// // const editorPreview = document.getElementById('editorPreview').contentWindow.document;
// const editorCopyButton = document.getElementById('editorCopyClipboard');

// // Monaco loader
// require.config({
//     paths: {
//         vs: "https://cdn.jsdelivr.net/npm/monaco-editor/min/vs"
//     }
// });

// window.MonacoEnvironment = {
//     getWorkerUrl: function (workerId, label) {
//         return `data:text/javascript;charset=utf-8,${encodeURIComponent(`
//     self.MonacoEnvironment = {
//       baseUrl: 'https://cdn.jsdelivr.net/npm/monaco-editor/min/'
//     };
//     importScripts('https://cdn.jsdelivr.net/npm/monaco-editor/min/vs/base/worker/workerMain.js');`)}`;
//     }
// };

// // Monaco init
// require(["vs/editor/editor.main"], function () {
//     createEditor(editorCode);
// });


// var button_index = 0;
// var isLast = true;

// function createEditor(editorContainer) {
//     let editor = monaco.editor.create(editorContainer, {
//         language: "html",
//         minimap: {
//             enabled: false
//         },
//         automaticLayout: true,
//         contextmenu: false,
//         fontSize: 14,
//         scrollbar: {
//             useShadows: false,
//             vertical: "visible",
//             horizontal: "visible",
//             horizontalScrollbarSize: 12,
//             verticalScrollbarSize: 12
//         },
//         suggest: {
//             showWords: false,
//             showFunctions: false,
//             showKeywords: false,
//             showSnippets: false,
//         },
//         quickSuggestions: false,
//         autoClosingBrackets: "never",
//         autoClosingQuotes: "never"
//     });



//     $(document).ready(function () {

//         editor.onDidChangeModelContent(() => {
//             const input = editor.getValue();
//             const lines = input.split("\n"); // Tách từng dòng
//             let questions_arr = [];
//             window.questions_arr = questions_arr;
//             let currentQuestion = null;

//             lines.forEach((line, index) => {
//                 line = line.trim();

//                 // Kiểm tra xem có phải là câu hỏi mới (bắt đầu bằng dấu ')
//                 if (line.startsWith("'")) {
//                     // Nếu có câu hỏi hiện tại, lưu nó vào mảng trước khi tạo câu hỏi mới
//                     if (currentQuestion) {
//                         questions_arr.push(currentQuestion);
//                     }

//                     // Khởi tạo câu hỏi mới
//                     currentQuestion = {
//                         lineNumber: index + 1,
//                         question_content: line.substring(1).trim(), // Nội dung câu hỏi
//                         question_options: [], // Mảng các lựa chọn
//                         answer: null // Câu trả lời đúng
//                     };
//                 } else if (currentQuestion && line !== "") {
//                     // Xử lý các lựa chọn đáp án
//                     const isCorrect = line.startsWith("*");
//                     const optionText = isCorrect ? line.substring(1).trim() : line;

//                     currentQuestion.question_options.push(optionText);
//                     if (isCorrect) {
//                         currentQuestion.answer = optionText;
//                     }
//                 }

//                 // Nếu là dòng cuối và vẫn còn câu hỏi đang xử lý, lưu câu hỏi đó
//                 if (index === lines.length - 1 && currentQuestion) {
//                     questions_arr.push(currentQuestion);
//                     if (isLast)
//                         button_index = questions_arr.length - 1;
//                 }
//             });

//             displayQuestions(questions_arr);
//             try {
//                 showQuestionDetail(questions_arr[button_index]);
//             } catch(err) {
//                 return;
//             }
//             console.log(questions_arr);
//         });
//     });

//     function displayQuestions(questions_arr) {
//         const previewDiv = document.getElementById("preview");
//         previewDiv.innerHTML = ""; // Xóa nội dung cũ

//         // Tạo nút cho từng câu hỏi
//         questions_arr.forEach((question, index) => {
//             const button = document.createElement("button");
//             button.textContent = `Câu ${index + 1}`;
//             button.style.margin = "5px";
//             button.onclick = function () {
//                 if (index != questions_arr.length - 1) 
//                     isLast = false;
//                 else 
//                     isLast = true;
//                 button_index = index;
//                 showQuestionDetail(question); // Hiển thị chi tiết câu hỏi khi bấm nút
//                 editor.setPosition({ lineNumber: question.lineNumber, column: 1 })
//                 editor.setScrollPosition({ scrollTop: question.lineNumber });
//                 editor.focus();
//             };
//             previewDiv.appendChild(button);
//         });

//         if (button_index === questions_arr.length - 1) {
//             showQuestionDetail(questions_arr[button_index]);
//         }
//     }

//     function showQuestionDetail(question) {
//         const questionDetailDiv = document.createElement("div");
//         questionDetailDiv.innerHTML = `<strong>Cau ${button_index + 1}: ${question.question_content}</strong><br>`;
        
//         // Xóa các chi tiết cũ
//         const contentPreview = document.getElementById("content-preview");
//         contentPreview.innerHTML = "";
        
        
//         // Thêm lại các nút câu hỏi
//         // displayQuestions(questions_arr);

//         // Thêm chi tiết câu hỏi
//         question.question_options.forEach((option, i) => {
//             const optionDiv = document.createElement("div");
//             optionDiv.textContent = `${String.fromCharCode(65 + i)}. ${option}`;
//             if (option === question.answer) {
//                 optionDiv.style.color = "green";
//                 optionDiv.innerHTML += " (Đáp án đúng)";
//             }
//             questionDetailDiv.appendChild(optionDiv);
//         });

//         contentPreview.appendChild(questionDetailDiv);
//     }


// }


document.addEventListener("DOMContentLoaded", function (event) {

    Quill.register('modules/imageResize', window.ImageResize.default);

    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
        [{ 'script': 'sub' }, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        ['link', 'image', 'video', 'formula'],          // add's image support
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ];

    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions,
            imageResize: {
                displaySize: true
            },
        },
    });
    var i = 0;

    
    quill.on('text-change', () => {
        let count = 0;
        let input = quill.root.innerHTML;

        // Tách nội dung theo đoạn (block) HTML
        let lines = input.split(/<\/?p>/).filter(line => line.trim() !== ""); // Loại bỏ các đoạn rỗng
        console.log(lines)

        let questions_arr = [];
        window.questions_arr = questions_arr;
        let currentQuestion = null;


        lines.forEach((line, index) => {
            line = line.trim();
        
            if (/^<.*?>$/.test(line) && /^<\/.*?>$/.test(line)) {
                return;
            } else {
                count += line.length + 1;
            }
        
            // Nếu là câu hỏi mới
            if (line.startsWith("'")) {
                // Lưu câu hỏi trước đó nếu có
                if (currentQuestion) {
                    questions_arr.push(currentQuestion);
                }
        
                // Tạo câu hỏi mới
                currentQuestion = {
                    lineNumber: count,
                    lineElement: $('.ql-editor').children()[index],
                    question_content: line.substring(1).trim(),
                    question_options: [],
                    answer: null,
                    currentSection: 'question' // Xác định đang xử lý phần nội dung câu hỏi
                };
            } 
            // Nếu là lựa chọn
            else if (currentQuestion && line.startsWith('-&gt;')) {
                // Đánh dấu rằng đang xử lý phần lựa chọn
                currentQuestion.currentSection = 'option';
        
                // Kiểm tra lựa chọn đúng hay sai
                const isCorrect = line.startsWith("-&gt;*");
                const optionHTML = isCorrect ? line.substring(6).trim() : line.substring(5).trim();
        
                // Thêm lựa chọn vào câu hỏi
                currentQuestion.question_options.push(optionHTML);
        
                // Nếu là đáp án đúng
                if (isCorrect) {
                    currentQuestion.answer = optionHTML;
                    currentQuestion.currentSection = 'answer'; // Chuyển sang trạng thái câu trả lời
                }
            } 
            // Nếu là dòng tiếp theo không bắt đầu bằng ký hiệu
            else if (currentQuestion) {
                // Phụ thuộc vào phần hiện tại đang xử lý
                if (currentQuestion.currentSection === 'question') {
                    currentQuestion.question_content += `<br>${line}`;
                } else if (currentQuestion.currentSection === 'option') {
                    // Thêm dòng này vào lựa chọn cuối cùng
                    const lastOptionIndex = currentQuestion.question_options.length - 1;
                    if (lastOptionIndex >= 0) {
                        currentQuestion.question_options[lastOptionIndex] += `<br>${line}`;
                    }
                } else if (currentQuestion.currentSection === 'answer') {
                    // Nối dòng này vào câu trả lời
                    const lastOptionIndex = currentQuestion.question_options.length - 1;
                    currentQuestion.answer += `<br>${line}`;
                    if (lastOptionIndex >= 0) {
                        currentQuestion.question_options[lastOptionIndex] += `<br>${line}`;
                    }
                }
            }
        
            // Nếu là dòng cuối và vẫn còn câu hỏi đang xử lý, lưu câu hỏi đó
            if (index === lines.length - 1 && currentQuestion) {
                questions_arr.push(currentQuestion);
            }
        });

        // Hiển thị danh sách câu hỏi và xem trước câu cuối cùng
        displayQuestions(questions_arr);
        button_index = questions_arr.length - 1; // Cập nhật chỉ số câu hỏi cuối
        if (questions_arr.length > 0) {
            showQuestionDetail(questions_arr[button_index]);
        }

        console.log(questions_arr);
    });

    var button_index = 0;

    function displayQuestions(questions_arr) {
        const previewDiv = document.getElementById("preview");
        previewDiv.innerHTML = ""; // Xóa nội dung cũ

        // Tạo nút cho từng câu hỏi
        questions_arr.forEach((question, index) => {
            const button = document.createElement("button");
            button.textContent = `Câu ${index + 1}`;
            button.style.margin = "5px";
            button.onclick = function () {
                button_index = index;
                showQuestionDetail(question);
                question.lineElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                // quill.setSelection(question.lineNumber, 0);
            };
            previewDiv.appendChild(button);
        });
    }

    function showQuestionDetail(question) {
        const questionDetailDiv = document.createElement("div");
        questionDetailDiv.innerHTML = `<strong>Câu ${button_index + 1}: ${question.question_content}</strong><br>`;

        const contentPreview = document.getElementById("content-preview");
        contentPreview.innerHTML = ""; // Xóa các chi tiết cũ

        // Thêm chi tiết câu hỏi
        question.question_options.forEach((option, i) => {
            const optionDiv = document.createElement("div");
            // optionDiv.textContent = `${String.fromCharCode(65 + i)}. ${option}`;
            optionDiv.innerHTML = `${String.fromCharCode(65 + i)}. ${option}`;
            if (option === question.answer) {
                optionDiv.style.color = "green";
                optionDiv.innerHTML += " (Đáp án đúng)";
            }
            questionDetailDiv.appendChild(optionDiv);
        });

        contentPreview.appendChild(questionDetailDiv);
    }
});
