<style>
        * {
            font-family: 'Merriweather', serif;
        }

        body {
            line-height: 1.6;
            background-color: #ffe4e1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            width: 100%;
            margin: 20px auto;
        }

        header {
            background: #fff;
            padding: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        header .logo img {
            margin-left: 100px;
            width: 100px;
            height: auto;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            flex-grow: 1;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #c9ad93;
        }

        .user-actions {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .user-actions .icon {
            text-decoration: none;
            color: #333;
            font-size: 20px;
            margin-left: 15px;
            transition: color 0.3s;
        }

        .user-actions .icon:hover {
            color: #c9ad93;
        }

        .user-actions .icon-cart {
            color: #000;
        }

        .user-actions .sign-in {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            margin-left: 15px;
            transition: color 0.3s;
        }

        .user-actions .sign-in:hover {
            color: #c9ad93;
        }

        .user-actions .cart-count {
            background: #c9ad93;
            color: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 14px;
            vertical-align: top;
            margin-left: 5px;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: auto;
        }

        .search-form {
            display: none;
            position: absolute;
            top: 50px;
            right: 50px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 4px;
            z-index: 1500;
        }

        .search-form input {
            width: 200px;
            padding: 5px;
            margin-right: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-form button {
            padding: 5px 10px;
            border: none;
            background-color: #8B4513;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #c9ad93;
        }
    </style>