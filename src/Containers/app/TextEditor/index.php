<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextEditor</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background: #f5f5f7;
            color: #1d1d1f;
            line-height: 1.47059;
            font-weight: 400;
            letter-spacing: -0.022em;
            overflow-x: hidden;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #ffffff;
            min-height: 100vh;
            border-left: 1px solid #d2d2d7;
            border-right: 1px solid #d2d2d7;
            position: relative;
        }

        .header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid #d2d2d7;
            padding: 20px 32px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 600;
            color: #1d1d1f;
            letter-spacing: -0.003em;
            text-align: center;
        }

        .toolbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid #d2d2d7;
            padding: 12px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 69px;
            z-index: 99;
        }

        .toolbar-left, .toolbar-right {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .btn {
            background: none;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #1d1d1f;
            transition: all 0.15s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            letter-spacing: -0.01em;
        }

        .btn:hover {
            background: #f5f5f7;
        }

        .btn:active {
            background: #e8e8ed;
            transform: scale(0.96);
        }

        .btn.primary {
            background: #007aff;
            color: white;
        }

        .btn.primary:hover {
            background: #0056d6;
        }

        .btn.secondary {
            background: #f5f5f7;
            color: #1d1d1f;
        }

        .btn.secondary:hover {
            background: #e8e8ed;
        }

        .btn.format {
            width: 32px;
            height: 32px;
            padding: 0;
            justify-content: center;
            border-radius: 6px;
            font-weight: 600;
        }

        .btn.format.active {
            background: #007aff;
            color: white;
        }

        .file-input {
            display: none;
        }

        .select-style {
            background: none;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #1d1d1f;
            cursor: pointer;
            transition: all 0.15s ease;
            letter-spacing: -0.01em;
        }

        .select-style:hover {
            background: #f5f5f7;
        }

        .editor-container {
            padding: 40px 32px;
            min-height: calc(100vh - 200px);
        }

        .editor {
            width: 100%;
            min-height: 500px;
            border: none;
            outline: none;
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Text', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #1d1d1f;
            background: transparent;
            resize: none;
            letter-spacing: -0.022em;
            font-weight: 400;
        }

        .editor::placeholder {
            color: #86868b;
        }

        .status-bar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: saturate(180%) blur(20px);
            border-top: 1px solid #d2d2d7;
            padding: 12px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #86868b;
            position: sticky;
            bottom: 0;
            z-index: 98;
        }

        .word-count {
            display: flex;
            gap: 24px;
        }

        .save-status {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #30d158;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .modal-content {
            background: white;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 420px;
            width: 90%;
        }

        .modal h3 {
            font-size: 20px;
            font-weight: 600;
            color: #1d1d1f;
            margin-bottom: 24px;
            letter-spacing: -0.01em;
        }

        .modal input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d2d2d7;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
            margin-bottom: 16px;
            outline: none;
            transition: border-color 0.15s ease;
        }

        .modal input:focus {
            border-color: #007aff;
        }

        .modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .divider {
            width: 1px;
            height: 20px;
            background: #d2d2d7;
            margin: 0 8px;
        }

        .fullscreen {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            max-width: none !important;
            border: none !important;
            z-index: 1000;
        }

        .format-group {
            display: flex;
            gap: 2px;
            background: #f5f5f7;
            padding: 2px;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .container {
                border-left: none;
                border-right: none;
            }
            
            .header, .toolbar, .editor-container, .status-bar {
                padding-left: 20px;
                padding-right: 20px;
            }
            
            .toolbar {
                flex-direction: column;
                gap: 12px;
                align-items: stretch;
            }
            
            .toolbar-left, .toolbar-right {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 24px;
            }
            
            .toolbar-left, .toolbar-right {
                flex-wrap: wrap;
                gap: 8px;
            }
            
            .btn {
                font-size: 13px;
                padding: 6px 12px;
            }
        }
        header {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }
        .WindowControll_close {
            background-color: red;
            width: 1vw;
            text-align: center;
            margin: 10px;
           text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container" id="container">
        <div class="header">
             <header>
        <a href="<?php echo "/LemonOS/public/home/index.php"?>">
        <p class="WindowControll_close">X</p>
        </a>
    </header>
        </div>

        <div class="toolbar">
            <div class="toolbar-left">
                <button class="btn" onclick="newDocument()">New</button>
                <label for="fileInput" class="btn">Open</label>
                <input type="file" id="fileInput" class="file-input" accept=".txt,.md,.html,.css,.js" onchange="openFile(event)">
                <button class="btn primary" onclick="saveFile()">Save</button>
                <button class="btn secondary" onclick="saveAsFile()">Save As</button>
                
                <div class="divider"></div>
                
                <button class="btn" onclick="undo()" title="Undo">↶</button>
                <button class="btn" onclick="redo()" title="Redo">↷</button>
            </div>

            <div class="toolbar-right">
                <div class="format-group">
                    <button class="btn format" onclick="formatText('bold')" title="Bold" id="boldBtn">B</button>
                    <button class="btn format" onclick="formatText('italic')" title="Italic" id="italicBtn">I</button>
                    <button class="btn format" onclick="formatText('underline')" title="Underline" id="underlineBtn">U</button>
                </div>
                
                <div class="divider"></div>
                
                <select class="select-style" onchange="changeFontSize(this.value)" id="fontSizeSelect">
                    <option value="14">14px</option>
                    <option value="16" selected>16px</option>
                    <option value="18">18px</option>
                    <option value="20">20px</option>
                    <option value="24">24px</option>
                    <option value="28">28px</option>
                </select>
                
                <div class="divider"></div>
                
                <button class="btn" onclick="findReplace()" title="Find & Replace">Find</button>
                <button class="btn" onclick="toggleFullscreen()" title="Fullscreen">⌘</button>
            </div>
        </div>

        <div class="editor-container">
            <textarea class="editor" id="editor" placeholder="Start writing..."></textarea>
        </div>

        <div class="status-bar">
            <div class="word-count">
                <span id="wordCount">0 words</span>
                <span id="charCount">0 characters</span>
            </div>
            <div class="save-status">
                <span class="status-dot"></span>
                <span id="saveStatus">Saved</span>
            </div>
        </div>
    </div>

    <!-- Find & Replace Modal -->
    <div class="modal" id="findReplaceModal">
        <div class="modal-content">
            <h3>Find & Replace</h3>
            <input type="text" id="findText" placeholder="Find">
            <input type="text" id="replaceText" placeholder="Replace with">
            <div class="modal-buttons">
                <button class="btn" onclick="closeFindReplace()">Cancel</button>
                <button class="btn" onclick="findNext()">Find Next</button>
                <button class="btn primary" onclick="replaceAll()">Replace All</button>
            </div>
        </div>
    </div>

    <!-- Save As Modal -->
    <div class="modal" id="saveAsModal">
        <div class="modal-content">
            <h3>Save As</h3>
            <input type="text" id="fileName" placeholder="Document name" value="Untitled.txt">
            <div class="modal-buttons">
                <button class="btn" onclick="closeSaveAs()">Cancel</button>
                <button class="btn primary" onclick="confirmSaveAs()">Save</button>
            </div>
        </div>
    </div>

    <script>
        let currentFileName = 'Untitled.txt';
        let undoStack = [];
        let redoStack = [];
        let isFullscreen = false;
        let lastSavedContent = '';

        const editor = document.getElementById('editor');
        const wordCountElement = document.getElementById('wordCount');
        const charCountElement = document.getElementById('charCount');
        const saveStatusElement = document.getElementById('saveStatus');

        // Initialize editor
        editor.addEventListener('input', function() {
            updateWordCount();
            updateSaveStatus();
            saveToUndoStack();
        });

        editor.addEventListener('keydown', function(e) {
            if (e.metaKey || e.ctrlKey) {
                switch(e.key) {
                    case 's':
                        e.preventDefault();
                        saveFile();
                        break;
                    case 'o':
                        e.preventDefault();
                        document.getElementById('fileInput').click();
                        break;
                    case 'n':
                        e.preventDefault();
                        newDocument();
                        break;
                    case 'f':
                        e.preventDefault();
                        findReplace();
                        break;
                    case 'z':
                        e.preventDefault();
                        if (e.shiftKey) {
                            redo();
                        } else {
                            undo();
                        }
                        break;
                    case 'y':
                        e.preventDefault();
                        redo();
                        break;
                    case 'b':
                        e.preventDefault();
                        formatText('bold');
                        break;
                    case 'i':
                        e.preventDefault();
                        formatText('italic');
                        break;
                    case 'u':
                        e.preventDefault();
                        formatText('underline');
                        break;
                }
            }
        });

        function updateWordCount() {
            const text = editor.value;
            const words = text.trim() ? text.trim().split(/\s+/).length : 0;
            const chars = text.length;
            
            wordCountElement.textContent = `${words} ${words === 1 ? 'word' : 'words'}`;
            charCountElement.textContent = `${chars} ${chars === 1 ? 'character' : 'characters'}`;
        }

        function updateSaveStatus() {
            const hasChanges = editor.value !== lastSavedContent;
            if (hasChanges) {
                saveStatusElement.textContent = 'Unsaved changes';
                document.querySelector('.status-dot').style.background = '#ff9500';
            } else {
                saveStatusElement.textContent = 'Saved';
                document.querySelector('.status-dot').style.background = '#30d158';
            }
        }

        function saveToUndoStack() {
            if (undoStack.length === 0 || undoStack[undoStack.length - 1] !== editor.value) {
                if (undoStack.length > 50) {
                    undoStack.shift();
                }
                undoStack.push(editor.value);
                redoStack = [];
            }
        }

        function undo() {
            if (undoStack.length > 1) {
                redoStack.push(undoStack.pop());
                editor.value = undoStack[undoStack.length - 1] || '';
                updateWordCount();
                updateSaveStatus();
            }
        }

        function redo() {
            if (redoStack.length > 0) {
                const value = redoStack.pop();
                undoStack.push(value);
                editor.value = value;
                updateWordCount();
                updateSaveStatus();
            }
        }

        function newDocument() {
            if (editor.value !== lastSavedContent) {
                if (!confirm('You have unsaved changes. Are you sure you want to create a new document?')) {
                    return;
                }
            }
            
            editor.value = '';
            currentFileName = 'Untitled.txt';
            lastSavedContent = '';
            undoStack = [''];
            redoStack = [];
            updateWordCount();
            updateSaveStatus();
        }

        function openFile(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    editor.value = e.target.result;
                    currentFileName = file.name;
                    lastSavedContent = e.target.result;
                    undoStack = [e.target.result];
                    redoStack = [];
                    updateWordCount();
                    updateSaveStatus();
                };
                reader.readAsText(file);
            }
        }

        function saveFile() {
            const content = editor.value;
            const blob = new Blob([content], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = currentFileName;
            a.click();
            URL.revokeObjectURL(url);
            
            lastSavedContent = content;
            updateSaveStatus();
        }

        function saveAsFile() {
            document.getElementById('fileName').value = currentFileName;
            document.getElementById('saveAsModal').style.display = 'flex';
            setTimeout(() => document.getElementById('fileName').focus(), 100);
        }

        function confirmSaveAs() {
            const fileName = document.getElementById('fileName').value.trim();
            if (fileName) {
                currentFileName = fileName;
                saveFile();
                closeSaveAs();
            }
        }

        function closeSaveAs() {
            document.getElementById('saveAsModal').style.display = 'none';
        }

        function formatText(command) {
            const start = editor.selectionStart;
            const end = editor.selectionEnd;
            const selectedText = editor.value.substring(start, end);
            
            if (selectedText) {
                let formattedText = selectedText;
                
                switch(command) {
                    case 'bold':
                        formattedText = `**${selectedText}**`;
                        break;
                    case 'italic':
                        formattedText = `*${selectedText}*`;
                        break;
                    case 'underline':
                        formattedText = `_${selectedText}_`;
                        break;
                }
                
                editor.value = editor.value.substring(0, start) + formattedText + editor.value.substring(end);
                editor.focus();
                editor.setSelectionRange(start + formattedText.length, start + formattedText.length);
                updateWordCount();
                updateSaveStatus();
                saveToUndoStack();
            }
        }

        function changeFontSize(size) {
            editor.style.fontSize = size + 'px';
        }

        function findReplace() {
            document.getElementById('findReplaceModal').style.display = 'flex';
            setTimeout(() => document.getElementById('findText').focus(), 100);
        }

        function findNext() {
            const findText = document.getElementById('findText').value;
            if (findText) {
                const content = editor.value;
                const currentPos = editor.selectionStart;
                const foundPos = content.indexOf(findText, currentPos);
                
                if (foundPos !== -1) {
                    editor.focus();
                    editor.setSelectionRange(foundPos, foundPos + findText.length);
                } else {
                    // Search from beginning
                    const foundFromStart = content.indexOf(findText, 0);
                    if (foundFromStart !== -1 && foundFromStart < currentPos) {
                        editor.focus();
                        editor.setSelectionRange(foundFromStart, foundFromStart + findText.length);
                    }
                }
            }
        }

        function replaceAll() {
            const findText = document.getElementById('findText').value;
            const replaceText = document.getElementById('replaceText').value;
            
            if (findText) {
                const newContent = editor.value.replaceAll(findText, replaceText);
                editor.value = newContent;
                updateWordCount();
                updateSaveStatus();
                saveToUndoStack();
                closeFindReplace();
            }
        }

        function closeFindReplace() {
            document.getElementById('findReplaceModal').style.display = 'none';
        }

        function toggleFullscreen() {
            const container = document.getElementById('container');
            
            if (!isFullscreen) {
                container.classList.add('fullscreen');
                isFullscreen = true;
            } else {
                container.classList.remove('fullscreen');
                isFullscreen = false;
            }
        }

        // Close modals when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal')) {
                e.target.style.display = 'none';
            }
        });

        // Handle escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('findReplaceModal').style.display = 'none';
                document.getElementById('saveAsModal').style.display = 'none';
                
                if (isFullscreen) {
                    toggleFullscreen();
                }
            }
        });

        // Initialize
        updateWordCount();
        saveToUndoStack();
        updateSaveStatus();
    </script>
</body>
</html>