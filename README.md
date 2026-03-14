# 🚀 WP Deletador

**WP Deletador** is an extreme lightweight and efficient WordPress plugin designed to help administrators perform bulk cleanup of old posts based on specific time and category criteria.

---

## 🛠️ Key Features

The plugin adds a control panel under **Settings → Apagar Postagens**, allowing:

* **Period Filter:** Delete posts older than "X" days and "H" hours.
* **Fixed Date Filter:** Delete everything published before a specific date and time.
* **Category Selection:** Apply rules to all categories or target a specific one.
* **Simulation Mode:** Preview exactly how many posts will be affected before executing.
* **Permanent Deletion:** Removes posts permanently (bypasses the trash) to optimize your database.

---

## 📂 Project Structure

The code is modularized for better maintenance and performance:

* `apagar-postagens-tempo.php`: Main bootstrap file and hooks.
* `includes/apt-constants.php`: Plugin constants (version, slug).
* `includes/apt-cutoff.php`: Date/time calculation logic.
* `includes/apt-query.php`: Query building, counting (preview), and deletion logic.
* `admin/apt-menu.php`: Menu registration and CSS enqueuing.
* `admin/apt-page.php`: Admin page logic (data sanitization and action handling).
* `admin/views/apt-form.php`: HTML templates for the settings form.

---

## ⚙️ Installation

1.  Download this repository or compress the plugin folder into a `.zip` file.
2.  In your WordPress dashboard, go to **Plugins > Add New > Upload Plugin**.
3.  Select the file and click **Install Now**.
4.  Activate the **"Apagar Postagens por Tempo"** plugin.
5.  Access the settings via **Settings > Apagar Postagens**.

---

## ⚠️ Security & Recommendations

* **Permissions:** Only users with `manage_options` capability (Administrators) can access the panel.
* **Protection:** The form uses `nonce` verification to prevent CSRF attacks.
* **Backup:** **Always perform a full backup** of your database and files before executing the deletion, as the process is irreversible.

---

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information or just put "Theago Liddell" in the credits :).
