const sheetId = "1yZHwP6z3171t4J0__2p19nQ-QB6yjcf8zbePo5qkuqI";
const sheetUrl = `https://docs.google.com/spreadsheets/d/${sheetId}/gviz/tq?tqx=out:json`;

let students = [];
let captchaAnswer;

// Load student data from Google Sheets
fetch(sheetUrl)
  .then(res => res.text())
  .then(rep => {
    const data = JSON.parse(rep.substring(47).slice(0, -2));
    const cols = data.table.cols.map(col => col.label);
    data.table.rows.forEach(row => {
      const student = {};
      row.c.forEach((cell, index) => {
        student[cols[index]] = cell ? cell.v : "";
      });
      students.push(student);
    });
    generateCaptcha();
    checkUrlForStudentId();
  })
  .catch(err => {
    console.error("Error loading student data:", err);
    showError("حدث خطأ في تحميل البيانات. يرجى المحاولة لاحقاً.");
  });

// Generate simple math captcha
function generateCaptcha() {
  const num1 = Math.floor(Math.random() * 10) + 1;
  const num2 = Math.floor(Math.random() * 10) + 1;
  captchaAnswer = num1 + num2;
  document.getElementById("captchaQuestion").textContent = `${num1} + ${num2} = ?`;
}

// Check URL for student ID parameter
function checkUrlForStudentId() {
  const urlParams = new URLSearchParams(window.location.search);
  const studentId = urlParams.get('id');
  
  if (studentId) {
    document.getElementById("studentNumber").value = studentId;
    searchStudent(true);
  }
}

// Validate captcha before showing results
function validateCaptcha() {
  const userAnswer = document.getElementById("captchaInput").value.trim();
  const number = document.getElementById("studentNumber").value.trim();
  
  if (!number) {
    showError("الرجاء إدخال الرقم الامتحاني");
    return;
  }
  
  if (userAnswer !== captchaAnswer.toString()) {
    showError("إجابة التحقق غير صحيحة. الرجاء المحاولة مرة أخرى.");
    generateCaptcha();
    return;
  }
  
  searchStudent(false);
}

// Search for student and display results
function searchStudent(skipCaptcha = false) {
  const number = document.getElementById("studentNumber").value.trim();
  const resultContainer = document.querySelector(".result-container");
  const shareSection = document.getElementById("shareSection");
  const student = students.find(s => s["number"] == number);

  if (student) {
    resultContainer.style.display = "block";
    shareSection.style.display = "block";
    
    // Display student info
    document.getElementById("studentName").innerHTML = `<i class="fas fa-user-graduate"></i> ${student["name"]}`;
    document.getElementById("studentId").textContent = number;
    
    // Display grades in grid
    const gradesGrid = document.getElementById("gradesGrid");
    gradesGrid.innerHTML = '';
    
    const subjects = [
      { name: "الرياضيات", icon: "fas fa-square-root-alt" },
      { name: "الفيزياء", icon: "fas fa-atom" },
      { name: "الكيمياء", icon: "fas fa-flask" },
      { name: "الأحياء", icon: "fas fa-dna" },
      { name: "العربية", icon: "fas fa-language" },
      { name: "الإنكليزية", icon: "fas fa-language" }
    ];
    
    let total = 0;
    let count = 0;
    
    subjects.forEach(subject => {
      if (student[subject.name]) {
        const grade = parseFloat(student[subject.name]);
        total += grade;
        count++;
        
        const gradeCard = document.createElement('div');
        gradeCard.className = 'grade-card';
        gradeCard.innerHTML = `
          <div class="subject-icon"><i class="${subject.icon}"></i></div>
          <div class="subject-name">${subject.name}</div>
          <div class="subject-grade">${grade}</div>
        `;
        gradesGrid.appendChild(gradeCard);
      }
    });
    
    // Calculate and display summary
    if (count > 0) {
      const average = (total / count).toFixed(2);
      document.getElementById("averageGrade").textContent = average;
      document.getElementById("percentage").textContent = `${Math.round((average / 100) * 100)}%`;
      
      let finalGrade = '';
      if (average >= 90) finalGrade = 'ممتاز';
      else if (average >= 80) finalGrade = 'جيد جداً';
      else if (average >= 70) finalGrade = 'جيد';
      else if (average >= 60) finalGrade = 'مقبول';
      else finalGrade = 'ضعيف';
      
      document.getElementById("finalGrade").textContent = finalGrade;
    }
    
    if (!skipCaptcha) {
      generateCaptcha();
    }
  } else {
    showError("لم يتم العثور على الطالب. الرجاء التأكد من الرقم الامتحاني.");
    shareSection.style.display = "none";
  }
  
  // Clear captcha input
  document.getElementById("captchaInput").value = "";
}

// Show error message
function showError(message) {
  const resultContainer = document.querySelector(".result-container");
  resultContainer.style.display = "block";
  resultContainer.innerHTML = `
    <div class="error-message">
      <i class="fas fa-exclamation-circle"></i> ${message}
    </div>
  `;
}

// Share student result
function shareResult() {
  const studentNumber = document.getElementById("studentNumber").value.trim();
  const currentUrl = window.location.href.split('?')[0];
  const shareUrl = `${currentUrl}?id=${studentNumber}`;
  
  document.getElementById("generatedLink").value = shareUrl;
  document.getElementById("shareLink").style.display = 'block';
  
  // Try to use Web Share API if available
  if (navigator.share) {
    navigator.share({
      title: 'نتيجة الطالب',
      text: 'انظر إلى نتائجي الدراسية',
      url: shareUrl
    }).catch(err => {
      console.log('Error sharing:', err);
    });
  }
}

// Copy share link to clipboard
function copyLink() {
  const linkInput = document.getElementById("generatedLink");
  linkInput.select();
  document.execCommand('copy');
  
  // Show feedback
  const copyBtn = document.querySelector("#shareLink button");
  const originalText = copyBtn.innerHTML;
  copyBtn.innerHTML = '<i class="fas fa-check"></i> تم النسخ!';
  
  setTimeout(() => {
    copyBtn.innerHTML = originalText;
  }, 2000);
}