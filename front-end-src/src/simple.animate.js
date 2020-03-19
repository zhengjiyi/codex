/* eslint-disable no-param-reassign */

HTMLElement.prototype.getElementTop = function getElementTop() {
  let top = this.offsetTop;
  let cur = this.offsetParent;
  while (cur != null) {
    top += cur.offsetTop;
    cur = cur.offsetParent;
  }
  return top;
};

export default function animateEle(scrollTop) {
  const wh = window.innerHeight;
  document.querySelectorAll('.anim').forEach((ele) => {
    if (ele.getElementTop() < wh + scrollTop - 60) {
      const effect = ele.getAttribute('data-effect');
      const duration = ele.getAttribute('data-duration');
      const newClassName = ele.className.replace('anim', `aminated ${effect}`);
      ele.className = newClassName;
      ele.style.visibility = 'visible';
      ele.style.animationDuration = duration;
    }
  });
}
