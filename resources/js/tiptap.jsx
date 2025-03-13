import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Bold from '@tiptap/extension-bold';
import Italic from '@tiptap/extension-italic';
import Heading from '@tiptap/extension-heading';
import BulletList from '@tiptap/extension-bullet-list';
import OrderedList from '@tiptap/extension-ordered-list';
import ListItem from '@tiptap/extension-list-item';
import TextAlign from '@tiptap/extension-text-align';
import Link from '@tiptap/extension-link';

document.addEventListener('DOMContentLoaded', () => {
    console.log("TipTap is initializing...");

    const editorElement = document.querySelector('#editor');
    const contentField = document.querySelector('#content'); // Ambil textarea tersembunyi

    if (!editorElement || !contentField) {
        console.error('Editor atau textarea tidak ditemukan! Pastikan ID-nya benar.');
        return;
    }

    // Sembunyikan textarea
    contentField.style.display = 'none';

    // Inisialisasi editor TipTap
    const editor = new Editor({
        element: editorElement,
        extensions: [
            StarterKit,
            Bold,
            Italic,
            Heading.configure({ levels: [1, 2] }),
            BulletList,
            OrderedList,
            ListItem,
            TextAlign.configure({ types: ['heading', 'paragraph'] }),
            Link.configure({ openOnClick: true }),
        ],
        content: contentField.value, // Ambil isi textarea saat pertama kali load
        onUpdate: () => {
            console.log("Content updated:", editor.getHTML());
            contentField.value = editor.getHTML(); // Simpan perubahan ke textarea
        }
    });

    console.log("TipTap successfully initialized.");

    // Tombol Toolbar
    document.querySelectorAll('button[data-action]').forEach(button => {
        button.addEventListener('click', () => {
            const action = button.getAttribute('data-action');

            switch (action) {
                case 'bold':
                    editor.chain().focus().toggleBold().run();
                    break;
                case 'italic':
                    editor.chain().focus().toggleItalic().run();
                    break;
                case 'heading1':
                    editor.chain().focus().toggleHeading({ level: 1 }).run();
                    break;
                case 'heading2':
                    editor.chain().focus().toggleHeading({ level: 2 }).run();
                    break;
                case 'bulletList':
                    editor.chain().focus().toggleBulletList().run();
                    break;
                case 'orderedList':
                    editor.chain().focus().toggleOrderedList().run();
                    break;
                case 'alignLeft':
                    editor.chain().focus().setTextAlign('left').run();
                    break;
                case 'alignCenter':
                    editor.chain().focus().setTextAlign('center').run();
                    break;
                case 'alignRight':
                    editor.chain().focus().setTextAlign('right').run();
                    break;
                case 'link':
                    const url = prompt('Masukkan URL:');
                    if (url) {
                        editor.chain().focus().setLink({ href: url }).run();
                    } else {
                        editor.chain().focus().unsetLink().run();
                    }
                    break;
                default:
                    console.warn(`Aksi ${action} tidak dikenali.`);
            }
        });
    });

    console.log('TipTap berhasil dimuat!');
});
