import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Bold from '@tiptap/extension-bold';
import BulletList from '@tiptap/extension-bullet-list';
import Heading from '@tiptap/extension-heading';
import Italic from '@tiptap/extension-italic';
import Link from '@tiptap/extension-link';
import ListItem from '@tiptap/extension-list-item';
import OrderedList from '@tiptap/extension-ordered-list';
import TextAlign from '@tiptap/extension-text-align';

window.addEventListener('load', () => {
    const editorElement = document.querySelector('#editor');

    if (!editorElement) {
        console.error('Editor element tidak ditemukan! Pastikan ID #editor ada di HTML.');
        return;
    }

    // Simpan editor ke global `window`
    window.editor = new Editor({
        element: editorElement,
        extensions: [
            StarterKit,
            Bold,
            Italic,
            Heading.configure({ levels: [1, 2, 3] }),
            OrderedList,
            BulletList,
            ListItem,
            Link.configure({ openOnClick: true }),
            TextAlign.configure({ types: ['heading', 'paragraph'] }),
        ],
        content: '', // kosongkan atau gunakan default text
    });

    console.log('Editor berhasil diinisialisasi:', window.editor);

    const form = document.querySelector('form');
    const contentField = document.querySelector('#content');

    if (form && contentField) {
        form.addEventListener('submit', () => {
            contentField.value = window.editor.getHTML();
        });
    } else {
        console.error('Form atau textarea #content tidak ditemukan.');
    }

    // Menambahkan EventListener ke Button Toolbar
    document.querySelectorAll('[data-action]').forEach((button) => {
        button.addEventListener('click', () => {
            const action = button.getAttribute('data-action');

            if (!window.editor) {
                console.error('Editor belum terinisialisasi!');
                return;
            }

            switch (action) {
                case 'bold':
                    window.editor.chain().focus().toggleBold().run();
                    break;
                case 'italic':
                    window.editor.chain().focus().toggleItalic().run();
                    break;
                case 'heading1':
                    window.editor.chain().focus().toggleHeading({ level: 1 }).run();
                    break;
                case 'heading2':
                    window.editor.chain().focus().toggleHeading({ level: 2 }).run();
                    break;
                case 'bulletList':
                    window.editor.chain().focus().toggleBulletList().run();
                    break;
                case 'orderedList':
                    window.editor.chain().focus().toggleOrderedList().run();
                    break;
                case 'alignLeft':
                    window.editor.chain().focus().setTextAlign('left').run();
                    break;
                case 'alignCenter':
                    window.editor.chain().focus().setTextAlign('center').run();
                    break;
                case 'alignRight':
                    window.editor.chain().focus().setTextAlign('right').run();
                    break;
                case 'link':
                    const url = prompt('Enter the link URL:');
                    if (url) {
                        window.editor.chain().focus().setLink({ href: url }).run();
                    }
                    break;
                default:
                    console.warn(`No action defined for: ${action}`);
            }
        });
    });
});
