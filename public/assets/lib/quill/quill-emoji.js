class EmojiModule {
  constructor(quill, options) {
    this.quill = quill;
    this.button = document.querySelector('.ql-emoji');
    this.picker = this.createPicker();

    this.button.addEventListener('click', () => {
      this.toggle();
    });

    document.addEventListener('click', (e) => {
      if (!this.picker.contains(e.target) && !this.button.contains(e.target)) {
        this.hide();
      }
    });
  }

  createPicker() {
    const picker = document.createElement('div');
    picker.className = 'emoji-picker';
    picker.style.display = 'none';

    EMOJIS.forEach(emoji => {
      const span = document.createElement('span');
      span.textContent = emoji;
      span.addEventListener('click', () => {
        const range = this.quill.getSelection(true);
        this.quill.insertText(range.index, emoji, 'user');
        this.quill.setSelection(range.index + emoji.length, 0);
        this.hide();
      });
      picker.appendChild(span);
    });

    document.body.appendChild(picker);
    return picker;
  }

  toggle() {
    this.picker.style.display === 'none' ? this.show() : this.hide();
  }

  show() {
    const rect = this.button.getBoundingClientRect();
    this.picker.style.top = rect.bottom + window.scrollY + 'px';
    this.picker.style.left = rect.left + window.scrollX + 'px';
    this.picker.style.display = 'block';
  }

  hide() {
    this.picker.style.display = 'none';
  }
}
