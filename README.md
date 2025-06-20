# 📚 Documentação das Rotas — Sistema de Chat, Amigos e Notificações

Todas as rotas abaixo estão protegidas pelos middlewares:

- 🔐 `auth` → Usuário autenticado
- 🔐 `verified` → Email verificado

---

## 💬 Chat (Mensagens Privadas e Públicas)

| Método | Rota                 | Nome da Rota     | Descrição                                          |
|--------|-----------------------|------------------|----------------------------------------------------|
| GET    | `/chat`               | `message.all`    | Exibe todos os chats ou interface principal.      |
| GET    | `/chat/{name}`        | `message.show`   | Abre conversa privada com o usuário `{name}`.     |
| POST   | `/sendMessage`        | `message`        | Envia uma mensagem privada.                       |
| POST   | `/sendMessageAll`     | `messageall`     | Envia uma mensagem pública para todos (broadcast).|
| POST   | `/typing`             | `message.typing` | Notifica que está digitando na conversa privada.  |

---

## 👥 Sistema de Amigos

| Método | Rota                             | Nome da Rota         | Descrição                                                     |
|--------|-----------------------------------|----------------------|---------------------------------------------------------------|
| GET    | `/friend`                        | `show.InviteFriend`  | Abre página de convites e gerenciamento de amigos.            |
| POST   | `/sendInvite`                    | `friend.invite`      | Envia um convite de amizade.                                  |
| GET    | `/friend/pedingInvite`           | `peding`             | Lista os convites **recebidos** (pendentes).                  |
| GET    | `/friend/sentInvite`             | `sent`               | Lista os convites **enviados**.                               |
| POST   | `/friend/accept/{name}`          | `accepted`           | Aceita o convite de amizade do usuário `{name}`.              |

---

## 🔔 Notificações

| Método | Rota          | Nome da Rota | Descrição                                  |
|--------|----------------|---------------|---------------------------------------------|
| GET    | `/notify`      | `notify.all`  | Lista todas as notificações do usuário.     |

---

## 🛠️ Detalhes Técnicos

- Middleware aplicado: `auth`, `verified`
- Sistema utiliza Laravel com Inertia.js + Vue.js
- Suporte a notificações em tempo real via Broadcast (WebSockets)

---



## 📂 Estrutura de Controllers

- `UserController`
- `InviteController`
- `MessageController`
- `NotifiyController`

---

## 📄 Exemplo de Configuração de Rotas

```php
Route::middleware(['auth', 'verified'])->group(function () {
    // Chat
    Route::get('/chat', [UserController::class, 'index'])->name('message.all');
    Route::get('/chat/{name}', [MessageController::class, 'showConversasion'])->name('message.show');
    Route::post('/sendMessage', [MessageController::class, 'sendMessagePrivate'])->name('message');
    Route::post('/sendMessageAll', function (Request $request) {
        broadcast(new MessagePublic($request->user()->name . " : " . $request->input('message')));
        return 'success';
    })->name('messageall');
    Route::post('/typing', [MessageController::class, 'typing'])->name('message.typing');

    // Notificações
    Route::get('/notify', [NotifiyController::class, 'index'])->name('notify.all');

    // Sistema de Amigos
    Route::get('/friend', fn() => Inertia::render('InviteFriend'))->name('show.InviteFriend');
    Route::post('/sendInvite', [InviteController::class, 'inviteFriend'])->name('friend.invite');
    Route::get('/friend/pedingInvite', [InviteController::class, 'peding'])->name('peding');
    Route::get('/friend/sentInvite', [InviteController::class, 'sentInvite'])->name('sent');
    Route::post('/friend/accept/{name}', [InviteController::class, 'acceptedFriend'])->name('accepted');
});
