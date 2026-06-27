<?php

namespace App\Http\Controllers\Dashboard;

use App\Ai\Agents\WriterAgent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Ai\Enums\Lab;

class AiWriteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $prompt = "Write a professional, well-structured blog post in English about: {$request->message}
            Use the following format by default:
            - A strong title like Laravel Events 101: Build a Decoupled, Scalable Application
            - A short **TL;DR** summary at the top
            - Clear numbered sections with headers
            - Practical Laravel examples and code snippets where relevant
            - A concise **Key Takeaways** section near the end
            - A final **Conclusion** that encourages the reader to act or learn more

            Structure your post as follows:
            1. **Engaging Introduction** - explain why the topic matters and what problem it solves
            2. **Table of Contents** (optional for longer posts)
            3. **Event Basics** - define key concepts clearly
            4. **Practical Examples** - show code and real use cases
            5. **Best Practices** - explain common patterns and pitfalls
            6. **Key Takeaways** - summarize the most important ideas
            7. **Conclusion** - close with next steps

            Guidelines:
            - Write for intermediate to advanced Laravel developers
            - Use clear, concise language with short paragraphs
            - Prefer bullets and small sections for readability
            - Include real-world Laravel event system examples
            - Use Markdown-style headings and code blocks
            - Keep the overall voice professional and practical
            ";

        // SSE response
        return WriterAgent::make()->stream(
            prompt: $prompt,
            provider: Lab::Groq,
            model: 'openai/gpt-oss-20b',
        );
    }
}