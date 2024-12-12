document.addEventListener("DOMContentLoaded", function (event) {

    Quill.register('modules/imageResize', window.ImageResize.default);
    // Quill.register('modules/formula', Formula);

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
                count += line.length+1;
            }

            // Kiểm tra xem có phải là câu hỏi mới (bắt đầu bằng dấu ')
            if (line.startsWith("'")) {
                // Lưu câu hỏi trước đó nếu có
                if (currentQuestion) {
                    questions_arr.push(currentQuestion);
                }

                // if (line === "<br>") return;

                // Tạo câu hỏi mới
                currentQuestion = {
                    lineNumber: count,
                    lineElement: $('.ql-editor').children()[index],
                    question_content: line.substring(1).trim(),
                    question_options: [],
                    answer: null
                };
            } else if (currentQuestion && line !== "") {
                // Xử lý các lựa chọn đáp án (loại bỏ dòng trống hoặc chỉ có <br>)
                
                const isCorrect = line.startsWith("*");
                const optionHTML = isCorrect ? line.substring(1).trim() : line;

                if (optionHTML !== "") {
                    if (line !== "<br>") {
                        currentQuestion.question_options.push(optionHTML);
                    }
                    if (isCorrect) {
                        currentQuestion.answer = optionHTML;
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
