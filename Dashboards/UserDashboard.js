
document.addEventListener('DOMContentLoaded', function () {

  // 1. NAV ITEM ACTIVE STATE
  const navItems = document.querySelectorAll('.nav-item');

  navItems.forEach(function (item) {
    item.addEventListener('click', function (e) {
      e.preventDefault();
      navItems.forEach(function (n) { n.classList.remove('active'); });
      this.classList.add('active');
    });
  });


  // 2. CATEGORY TAG FILTER
  const tags = document.querySelectorAll('.tag');

  tags.forEach(function (tag) {
    tag.addEventListener('click', function () {
      tags.forEach(function (t) { t.classList.remove('active'); });
      this.classList.add('active');
    });
  });

  // 3. POST BUTTON — placeholder action
  const postBtn = document.querySelector('.post-btn');
  if (postBtn) {
    postBtn.addEventListener('click', function () {
      alert('Post feature coming soon!');
    });
  }

});