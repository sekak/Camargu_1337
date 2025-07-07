<?php
include_once __DIR__ . "/../controllers/Post.controller.php";
require_once __DIR__ .'/../utils/authMiddleware.php';

redirectIfNotAuthenticated();

$postController = new Post_controller();
$posts = $postController->getPostsByUserId();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-y..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
        }

        .home {
            display: flex;
            min-height: 100vh;
        }

        .sidebar_home {
            width: 250px;
            padding: 20px;
        }

        .main-content {
            flex: 1;
            margin-top: 80px;
            width: calc(100% - 250px);
        }

        .main-content h1 {
            font-size: 2rem;
        }

        .gallery-container {
            display: flex;
            gap: 10px;
            padding: 20px;
        }

        .gallery {
            flex: 4;
            width: 100%;
            display: flex;
            flex-direction: column;
            padding: 20px;
            overflow: hidden;
        }

        .thumbnail {
            flex: 1;
            height: calc(100vh - 200px);
        }

        .thumbnail h2 {
            font-size: 1.2rem;
        }

        .thubmnail-images {
            height: 100%;
            overflow-y: scroll;
        }

        .thubmnail-images img {
            width: 100%;
            height: auto;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .img-container {
            width: 100%;
            display: flex;
            gap: 20px;
        }

        .img-wrapper {
            position: relative;
            width: 100%;
            max-width: 500px;
            aspect-ratio: 1 / 1;
            /* This makes it always a square */
            border: 1px solid #ccc;
            border-radius: 20px;
            overflow: hidden;
        }

        .img-wrapper img,
        .img-wrapper video,
        .img-wrapper .superpose {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
            position: absolute;
            top: 0;
            left: 0;
        }

        .img-btn {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 20%;
        }

        .img-btn button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .img-btn label {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            border: 1px solid #ccc;
            text-align: center;
        }


        .superpose-img {
            display: flex;
            margin-top: 80px;
        }

        .superpose-img-item {
            display: flex;
            flex-wrap: nowrap;
            gap: 10px;
            overflow-x: auto;
            overflow-y: hidden;
            width: 100%;
            padding: 10px 0;
        }

        .superpose-img img {
            width: 100px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            object-fit: cover;
        }


        .superpose-img img {
            width: 100px;
            height: 100px;
        }

        .preview-image,
        .video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
            display: none;
        }

        .superpose {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        @media (max-width: 920px) {

            .sidebar_home {
                width: 150px;
            }

            .main-content {
                width: calc(100% - 150px);
            }

            .gallery-container {
                flex-direction: column;
            }

            .thumbnail {
                height: auto;
            }

            .img-container {
                flex-direction: column;
            }

            .img-btn {
                width: 100%;
            }

        }

        @media (max-width: 624px) {
            .sidebar_home {
                width: 50px;
            }
        }

        .items-thumbnail {
            position: relative;
            display: inline-block;
            margin: 5px;
        }

        .items-thumbnail img {
            width: 100%;
            height: 100%;
            border-radius: 5px;
        }

        .items-thumbnail .item-btn-fas {
            position: absolute;
            top: 5px;
            right: 5px;
            color: red;
            cursor: pointer;
            font-size: 1.2rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            padding: 2px 5px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include_once("./includes/navbar.php"); ?>

    <!-- Page Layout -->
    <main class="home">
        <!-- Sidebar -->
        <div class="sidebar_home">
            <?php include_once("./includes/sidebar.php"); ?>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="gallery-container">
                <div class="gallery">
                    <h1>Create Your Image</h1>
                    <div class="img-container">
                        <div class="img-wrapper">
                            <img id="previewImage" src="" alt="Image Preview" class="preview-image" />
                            <video id="captureImage" autoplay playsinline class="video"></video>
                            <img id="superpose-layer" class="superpose" style="display: none;" />
                        </div>

                        <div class="img-btn">
                            <button id="capture-btn">Capture</button>
                            <button id="start-camera-btn">Start Camera</button>
                            <label id="label-avatar" for="avatar" class="btn">Upload</label>
                            <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"
                                style="display: none;" />
                        </div>
                    </div>
                    <div class="superpose-img" id="superpose-img">
                        <div class="superpose-img-item" id="superpose-img-item">
                            <img src="/public/img1.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img2.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img3.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img4.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img5.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img6.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img7.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img8.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img9.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img11.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img12.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img13.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img14.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img15.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img16.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img18.png" alt="Superposed Image 1" id="ticket" />
                            <img src="/public/img19.png" alt="Superposed Image 1" id="ticket" />
                        </div>
                    </div>
                </div>
                <div class="thumbnail">
                    <h2>Previous Creations</h2>
                    <div class="thubmnail-images">
                        <?php if (empty($posts)): ?>
                            <p>No previous creations available.</p>
                        <?php else: ?>
                            <?php foreach ($posts as $post): ?>
                                <div class="items-thumbnail">
                                    <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="Thumbnail Image" />
                                    <i class="item-btn-fas fas fa-times close-btn"
                                        onclick="handleClickDelete(<?php echo $post['id']; ?>)" title="Remove"></i>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php include_once __DIR__ . "/includes/footer.php" ?>
        </div>
    </main>


    <script>
        window.addEventListener('DOMContentLoaded', () => {
            let isSuperposed = [];
            let saveBtn = null;
            let cancelBtn = null;
            let isUploaded = false;

            const uploadBtn = document.getElementById('avatar');
            const previewImage = document.getElementById('previewImage');
            const captureBtn = document.getElementById('capture-btn');
            const startCameraBtn = document.getElementById('start-camera-btn');
            const video = document.getElementById('captureImage');
            const superposeImages = document.querySelectorAll('#ticket');
            const superposeImageItem = document.getElementById('superpose-img-item');
            const superposeImg = document.getElementById('superpose-img');
            const avatarLabel = document.getElementById('label-avatar');

            captureBtn.style.display = 'none';
            superposeImageItem.style.pointerEvents = 'none';
            superposeImg.style.cursor = 'not-allowed';

            function stopCamera() {
                if (video.srcObject) {
                    video.srcObject.getTracks().forEach(track => track.stop());
                }
            }

            function resetSuperposedImages() {
                isSuperposed.forEach(id => {
                    const img = document.getElementById(id);
                    if (img) img.remove();
                });
                isSuperposed = [];
                captureBtn.style.display = 'none';
            }

            function removeSaveBtn() {
                if (saveBtn) {
                    saveBtn.remove();
                    saveBtn = null;
                }
            }

            function generateFinalImage(baseElement) {
                let originalWidth, originalHeight;

                if (baseElement.tagName === 'VIDEO') {
                    originalWidth = baseElement.videoWidth;
                    originalHeight = baseElement.videoHeight;
                } else if (baseElement.tagName === 'IMG') {
                    originalWidth = baseElement.naturalWidth;
                    originalHeight = baseElement.naturalHeight;
                } else {
                    return;
                }

                const size = Math.min(originalWidth, originalHeight);

                const canvas = document.createElement('canvas');
                canvas.width = size;
                canvas.height = size;

                const ctx = canvas.getContext('2d');

                // Calculate crop center
                const sx = (originalWidth - size) / 2;
                const sy = (originalHeight - size) / 2;

                ctx.drawImage(baseElement, sx, sy, size, size, 0, 0, size, size);

                // Draw superposed images
                isSuperposed.forEach(id => {
                    const imgEl = document.getElementById(id);
                    if (imgEl) {
                        ctx.drawImage(imgEl, 0, 0, size, size);
                    }
                });

                return canvas.toDataURL('image/jpeg');
            }



            superposeImages.forEach(superpose => {
                superpose.addEventListener('click', () => {
                    const idName = `${superpose.src.split('/').pop().split('.')[0]}`;
                    const existingImg = document.getElementById(idName);

                    if (existingImg) {
                        existingImg.remove();
                        isSuperposed = isSuperposed.filter(item => item !== idName);
                        if (isSuperposed.length === 0) captureBtn.style.display = 'none';
                        return;
                    }

                    const img = document.createElement('img');
                    img.src = superpose.src;
                    img.classList.add('superpose');
                    img.id = idName;

                    video.insertAdjacentElement('afterend', img);
                    isSuperposed.push(idName);
                    captureBtn.style.display = 'inline-block';
                });
            });

            uploadBtn.addEventListener('change', (e) => {
                if (e.target.files.length === 0 || !previewImage) return;
                isUploaded = true;
                if (!cancelBtn) {
                    cancelBtn = document.createElement('button');
                    cancelBtn.textContent = 'Cancel Upload';
                    uploadBtn.insertAdjacentElement('afterend', cancelBtn);

                    cancelBtn.addEventListener('click', () => {
                        previewImage.src = '';
                        previewImage.style.display = 'none';
                        video.style.display = 'none';
                        uploadBtn.value = '';
                        startCameraBtn.style.display = 'inline-block';
                        cancelBtn.remove();
                        cancelBtn = null;
                        avatarLabel.style.display = '';

                        superposeImageItem.style.pointerEvents = 'none';
                        superposeImg.style.cursor = 'not-allowed';
                        resetSuperposedImages();
                        stopCamera();
                        removeSaveBtn();
                    });
                }

                const imgURL = URL.createObjectURL(e.target.files[0]);
                previewImage.src = imgURL;
                video.style.display = 'none';
                startCameraBtn.style.display = 'none';
                avatarLabel.style.display = 'none';
                previewImage.style.display = 'block';

                superposeImageItem.style.pointerEvents = 'fill';
                superposeImg.style.cursor = 'pointer';
                stopCamera();

                removeSaveBtn();

            });

            startCameraBtn.addEventListener('click', () => {
                isUploaded = false;
                avatarLabel.style.display = 'none';
                startCameraBtn.style.display = 'none';
                previewImage.style.display = 'none';
                video.style.display = 'block';

                navigator.mediaDevices.getUserMedia({ video: true })
                    .then((stream) => {
                        video.srcObject = stream;

                        superposeImageItem.style.pointerEvents = 'fill';
                        superposeImg.style.cursor = 'pointer';

                        if (!cancelBtn) {
                            cancelBtn = document.createElement('button');
                            cancelBtn.textContent = 'Cancel Camera';
                            uploadBtn.insertAdjacentElement('afterend', cancelBtn);

                            cancelBtn.addEventListener('click', () => {
                                stopCamera();
                                video.style.display = 'none';
                                previewImage.style.display = 'none';
                                startCameraBtn.style.display = 'inline-block';
                                cancelBtn.remove();
                                cancelBtn = null;
                                avatarLabel.style.display = '';

                                superposeImageItem.style.pointerEvents = 'none';
                                superposeImg.style.cursor = 'not-allowed';
                                resetSuperposedImages();
                                removeSaveBtn();
                            });
                        }
                    })
                    .catch((error) => {
                    });
            });

            captureBtn.addEventListener('click', () => {

                // if isUploaded, then generate image with width and height else send video
                if (isUploaded) {
                    previewImage.src = generateFinalImage(previewImage);
                }
                else
                    previewImage.src = generateFinalImage(video);
                previewImage.style.display = 'block';
                video.style.display = 'none';
                stopCamera();
                captureBtn.style.display = 'none';

                if (!saveBtn) {
                    saveBtn = document.createElement('button');
                    saveBtn.textContent = 'Save';
                    uploadBtn.insertAdjacentElement('afterend', saveBtn);
                }
                saveBtn.style.display = 'inline-block';
                saveBtn.onclick = () => {
                    const imgID = Math.floor(Math.random() * 1000000);

                    fetch('/actions/saveImage.actions.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `imgData=${encodeURIComponent(previewImage.src)}&imgID=${imgID}`
                    })
                        .then(response => response.text())
                        .then(text => {
                            if (text.includes('success')) {
                                alert('Image saved successfully!');
                                location.reload(); // Reload the page to reflect changes
                            } else {
                                alert('Failed to save image. Please try again.');
                            }
                            removeSaveBtn();
                            resetSuperposedImages();
                            previewImage.src = '';
                            previewImage.style.display = 'none';
                            video.style.display = 'none';
                            startCameraBtn.style.display = 'inline-block';
                            avatarLabel.style.display = '';
                            superposeImageItem.style.pointerEvents = 'none';
                            superposeImg.style.cursor = 'not-allowed';
                            stopCamera();
                            isSuperposed = [];
                            isUploaded = false;
                            if (cancelBtn) {
                                cancelBtn.remove();
                                cancelBtn = null;
                            }
                        })
                        .catch(error => {
                        });
                };
            });

        });

        function handleClickDelete(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                fetch(`/actions/deletePost.actions.php?id=${postId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${postId}`
                })
                    .then(response => response.text())
                    .then(data => {
                        location.reload(); // Reload the page to reflect changes
                    })
                    .catch(error => {
                    });
            }
        }
    </script>
</body>

</html>