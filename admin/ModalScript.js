function fetchModal(fileName, targetDivId) {
  console.log(fileName, targetDivId);
  fetch(fileName)
    .then((response) => response.text())
    .then((data) => {
      // Insert the fetched content into the target div
      document.getElementById(targetDivId).innerHTML = data;
    })
    .catch((error) => {
      console.error("Error loading the component:", error);
    });
}

const getQuizModal = () => {
  document.getElementById("modal").classList.remove("hidden");
  fetchModal("AddQuizModal.php", "modal");
};

const removeQuizModal = () => {
  document.getElementById("modal").classList.add("hidden");
};

const getLessonModal = () => {
  document.getElementById("modal").classList.remove("hidden");
  fetchModal("AddLessons.php", "modal");
};
const removeLessonModal = () => {
  document.getElementById("modal").classList.add("hidden");
};

const getProfileModal = () => {
  fetchModal("AdminProfile.php", "profile-modal");
  document.getElementById("profile-modal").classList.remove("hidden");
};
const removeProfileModal = () => {
  document.getElementById("profile-modal").classList.add("hidden");
};

const getCourseModal = () => {
  fetchModal("AddCourseModal.php", "course-modal");
  document.getElementById("course-modal").classList.remove("hidden");
};
const removeCourseModal = () => {
  document.getElementById("course-modal").classList.add("hidden");
};