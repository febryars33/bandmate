import type { Genre } from "./genre";

export type Artist = {
    id: number;
    spotify_artist_id: string | null;
    name: string;
    slug: string;
    about: string;
    is_verified: boolean;
    spotify_synced_at: string;
    few_genres: Genre[];
};
