import type { Discography } from "./discography";
import type { Genre } from "./genre";
import type { ArtistMusician } from "./pivots/artist_musician";
import type { Regency } from "./regency";

export type Artist = {
    id: number;
    regency_id: number | null;
    regency_name: string | null;
    spotify_artist_id: string | null;
    name: string;
    slug: string;
    about: string;
    is_verified: boolean;
    spotify_synced_at: string;
    few_genres: Genre[];
    regency?: Regency | null;
    genres: Genre[];
    discographies: Discography[];
    complete_lineups: ArtistMusician[];
    current_lineups: ArtistMusician[];
    past_members: ArtistMusician[];
};
