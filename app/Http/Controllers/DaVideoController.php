<?php

namespace App\Http\Controllers;

use App\Models\DaVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DaVideoController extends Controller
{
    /**
     * Display a listing of the videos.
     */
    public function index()
    {
        $videos = DaVideo::latest()->paginate(10);
        return view('crm.videos.index', compact('videos'));
    }

    /**
     * Show the index page with Create Mode enabled.
     */
    public function create()
    {
        $videos = DaVideo::latest()->paginate(10);
        $createMode = true;
        return view('crm.videos.index', compact('videos', 'createMode'));
    }

    /**
     * Store a newly created video in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            // Max size set to 10MB (10240 KB), adjust as needed
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240', 
        ]);

        $video = new DaVideo();
        $video->title = $request->title;
        $video->url = $request->url;

        // Direct Image Upload (No Compression)
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            
            // Generate a unique filename with the original extension
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Define the destination path
            $destinationPath = public_path('uploads/thumbnails');

            // Create the folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the uploaded file directly to the destination folder
            $image->move($destinationPath, $filename);

            // Save the filename in the database
            $video->thumbnail = $filename;
        }

        $video->save();
        return redirect()->route('videos.index')->with('success', 'Video added successfully!');
    }

    /**
     * Show the index page with Edit Mode and Video data.
     */
    public function edit(DaVideo $video)
    {
        $videos = DaVideo::latest()->paginate(10);
        $editMode = true;
        return view('crm.videos.index', compact('videos', 'video', 'editMode'));
    }

    /**
     * Update the specified video in storage.
     */
    public function update(Request $request, DaVideo $video)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
        ]);

        $video->title = $request->title;
        $video->url = $request->url;

        // Direct Image Update (No Compression)
        if ($request->hasFile('thumbnail')) {
            // Delete the old image if it exists
            if ($video->thumbnail && file_exists(public_path('uploads/thumbnails/' . $video->thumbnail))) {
                unlink(public_path('uploads/thumbnails/' . $video->thumbnail));
            }

            $image = $request->file('thumbnail');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/thumbnails');

            // Move the new file
            $image->move($destinationPath, $filename);
            
            $video->thumbnail = $filename;
        }

        $video->save();
        return redirect()->route('videos.index')->with('success', 'Video updated successfully!');
    }

    /**
     * Remove the specified video from storage.
     */
    public function destroy(DaVideo $video)
    {
        // Delete the associated image file when the record is deleted
        if ($video->thumbnail && file_exists(public_path('uploads/thumbnails/' . $video->thumbnail))) {
            unlink(public_path('uploads/thumbnails/' . $video->thumbnail));
        }
        
        $video->delete();
        return back()->with('success', 'Video deleted successfully!');
    }
}