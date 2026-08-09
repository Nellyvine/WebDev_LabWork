# Classwork — Club Members Manager

**Duration:** 1 hour · **Total: 100 marks** · **Individual work**

You are given a half-finished web app for managing a school club's member list.
The HTML is broken, the JavaScript validation is missing, and the PHP does not
save anything yet. Your job is to finish it.

## Setup (5 min)

1. Copy the `starter/` folder into your web server root (`htdocs/` for XAMPP,
   `www/` for WAMP). Rename it `members`.
2. Open phpMyAdmin → **Import** → choose `schema.sql` → **Go**.
   This creates the `club_db` database, the `members` table and 4 sample rows.
3. If your MySQL password is not blank, edit `config.php`.
   `config.php` opens a MySQLi connection called **`$conn`** — use that
   everywhere.
4. Visit `http://localhost/members/login.php`.
   Log in with **admin / admin123**.

If the page looks broken at this point — good. That is Task 1.

---

## Task 1 — Fix the HTML (15 min · 20 marks)

`form.php` contains **10 HTML errors**. Find and fix all of them.

Some are cosmetic, some will stop your PHP from ever receiving the data, so fix
them before you start Task 3.

Rules:
- The page must pass the W3C validator (https://validator.w3.org/#validate_by_input)
  with zero errors.
- Clicking a `<label>` must focus its matching field.
- The form must send data to `process.php` using POST.

Write the 10 errors you found in `ANSWERS.txt`, one per line, like this:

```
1. Line 12 - missing closing </div> tag
2. ...
```

**Marks:** 1 per error correctly listed, 1 per error correctly fixed.

---

## Task 2 — JavaScript validation (15 min · 25 marks)

Open `assets/validation.js`. Complete every `TODO`.

The form must **not** submit if any rule below fails. Show the message inside
the matching `<span class="error">` element and add the class `invalid` to the
field.

| Field | Rule | Message |
|---|---|---|
| Full name | Required, at least 3 characters, letters and spaces only | `Enter the member's full name (letters only).` |
| Email | Required, valid email format | `Enter a valid email, e.g. name@school.mu` |
| Phone | Required, exactly 8 digits, must start with 5 | `Phone must be 8 digits starting with 5.` |
| Role | Must be chosen (not the placeholder option) | `Choose a role.` |
| Fee paid | Required, a number, 0 or more, max 5000 | `Fee must be between 0 and 5000.` |
| Date joined | Required, cannot be in the future | `Date joined cannot be in the future.` |

Also:
- Clear a field's error as soon as the user starts typing in it (`input` event).
- Put the cursor in the **first** invalid field after a failed submit.

**Marks:** 3 per rule (18) + 4 for clearing errors + 3 for focusing the first
invalid field.

> Do not use `required` / `pattern` HTML attributes to do this for you. Write
> the JavaScript.

---

## Task 3 — PHP CRUD + sessions (20 min · 45 marks)

### 3a. Sessions (15 marks)

- `login.php` — check the username and password against `$USERS` using
  `password_verify()`. On success start a session, regenerate the session ID,
  store `user` and `name` in `$_SESSION`, then redirect to `index.php`.
  On failure show `Wrong username or password.` and stay on the page.
- `auth.php` — write `require_login()`. If there is no logged-in user, redirect
  to `login.php` and stop the script.
- `logout.php` — empty `$_SESSION`, destroy the session, redirect to `login.php`.
- Every page except `login.php` must call `require_login()` at the top.
- The header must show `Signed in as <name>`.

### 3b. Create, Read, Update, Delete (30 marks)

| File | What you write |
|---|---|
| `index.php` | **Read** — list all members, newest first |
| `process.php` | **Create** when `id` is empty, **Update** when `id` is set |
| `form.php` | Load the row when editing so the fields are pre-filled |
| `delete.php` | **Delete** the row, only when the request method is POST |

Requirements:
- Use **MySQLi prepared statements**: `prepare()` → `bind_param()` →
  `execute()`. A query with a variable pasted straight into the SQL string
  scores 0 for that operation.
- The type string in `bind_param()` has one letter per `?`:
  `s` string, `i` integer, `d` decimal. `fee_paid` is `d`, `id` is `i`,
  everything else is `s`.
- After every write, put a message in `$_SESSION['flash']` and redirect
  (`header('Location: index.php'); exit;`). Do not print HTML after a write.
- Escape everything you print with `htmlspecialchars()`.
- Deleting must ask "Are you sure?" first.

**Marks:** Create 7 · Read 6 · Update 8 · Delete 6 · prepared statements and
escaping used throughout 3.

> `$conn` is your MySQLi connection, already made for you in `config.php`.
> For reading a prepared SELECT, use
> `$stmt->get_result()->fetch_assoc()`.

---

## Marking summary

| Task | Marks |
|---|---|
| 1 — HTML fixes | 20 |
| 2 — JS validation | 25 |
| 3a — Sessions | 15 |
| 3b — CRUD | 30 |
| Code readability, indentation, no leftover TODOs | 10 |
| **Total** | **100** |