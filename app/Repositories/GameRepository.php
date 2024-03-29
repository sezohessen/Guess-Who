<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Game;
use App\Models\GameTheme;
use Illuminate\Database\Eloquent\Collection;

class GameRepository implements RepositoryInterface
{
    public function getAll(): Collection
    {
        return Game::all();
    }

    public function getOne($id): ?Game
    {
        return Game::find($id);
    }

    public function create($gameThemeId): Game
    {
        $gameTheme = GameTheme::with('themeObjects')->findOrFail($gameThemeId);

        $game = new Game([
            'game_theme_id' => $gameTheme->id,
        ]);
        $game->save();

        return $game;
    }

    public function update($id, array $data): bool
    {
        $game = Game::find($id);
        if (!$game) {
            return false;
        }

        return $game->update($data);
    }

    public function delete($id): bool
    {
        $game = Game::find($id);
        if (!$game) {
            return false;
        }
        $game->players()->delete();
        return $game->delete();
    }
}